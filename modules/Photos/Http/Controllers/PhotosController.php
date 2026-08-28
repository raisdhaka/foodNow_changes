<?php

namespace Modules\Photos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Modules\Photos\Models\Album;
use Modules\Photos\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhotosController extends Controller
{
    /**
     * Display a listing of the albums.
     * @return Response
     */
    public function index()
    {
        $albums = Album::orderBy('sort_order')->get();
        return view('photos::index', compact('albums'));
    }

    /**
     * Display the specified album with its photos.
     * @param string $slug
     * @return Response
     */
    public function albums($slug = null)
    {
        if ($slug) {
            $album = Album::where('slug', $slug)->firstOrFail();
            $photos = $album->photos;
            return view('photos::albums.show', compact('album', 'photos'));
        }
        
        $albums = Album::orderBy('sort_order')->get();
        return view('photos::albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new album.
     * @return Response
     */
    public function createAlbum()
    {
        return view('photos::albums.create');
    }

    /**
     * Show the form for editing an album.
     * @param int $albumId
     * @return Response
     */
    public function editAlbum($albumId)
    {
        $album = Album::findOrFail($albumId);
        return view('photos::albums.edit', compact('album'));
    }

    /**
     * Update the specified album.
     * @param Request $request
     * @param int $albumId
     * @return Response
     */
    public function updateAlbum(Request $request, $albumId)
    {
        $album = Album::findOrFail($albumId);
        
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $album->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('photos.albums.show', $album->slug)
            ->with('success', 'Album updated successfully');
    }

    /**
     * Store a newly created album in storage.
     * @param Request $request
     * @return Response
     */
    public function storeAlbum(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $album = new Album([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'company_id' => $this->getRestaurant()->id ?? 1, // Adjust based on your auth system
        ]);

        $album->save();

        return redirect()->route('photos.albums.show', $album->slug)->with('success', 'Album created successfully');
    }

    /**
     * Upload photos to an album.
     * @param Request $request
     * @param int $albumId
     * @return Response
     */
    public function uploadPhotos(Request $request, $albumId)
    {
        $album = Album::findOrFail($albumId);
        
        $request->validate([
            'photos' => 'required|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $lastSortOrder = $album->photos()->max('sort_order') ?? 0;

        foreach ($request->file('photos') as $key => $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('photos', $filename, 'public');
            
            $photo = new Photo([
                'album_id' => $album->id,
                'file_name' => $filename,
                'file_path' => '/storage/' . $filePath,
                'title' => $file->getClientOriginalName(),
                'sort_order' => $lastSortOrder + $key + 1,
            ]);
            
            $photo->save();
        }

        return response()->json(['success' => 'Photos uploaded successfully']);
    }

    /**
     * Update photo details
     * @param Request $request
     * @param int $photoId
     * @return Response
     */
    public function updatePhoto(Request $request, $photoId)
    {
        $photo = Photo::findOrFail($photoId);
        
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string',
        ]);

        $photo->update($request->only(['title', 'description']));
        
        return response()->json(['success' => 'Photo updated successfully']);
    }

    /**
     * Update the photo order in an album
     * @param Request $request
     * @return Response
     */
    public function updatePhotoOrder(Request $request)
    {
        $request->validate([
            'photos' => 'required|array',
            'photos.*' => 'integer|exists:photos,id',
        ]);

        $photos = $request->input('photos');
        
        foreach ($photos as $index => $photoId) {
            Photo::where('id', $photoId)->update(['sort_order' => $index]);
        }
        
        return response()->json(['success' => 'Photo order updated successfully']);
    }

    /**
     * Update the album order
     * @param Request $request
     * @return Response
     */
    public function updateAlbumOrder(Request $request)
    {
        $request->validate([
            'albums' => 'required|array',
            'albums.*' => 'integer|exists:albums,id',
        ]);

        $albums = $request->input('albums');
        
        foreach ($albums as $index => $albumId) {
            Album::where('id', $albumId)->update(['sort_order' => $index]);
        }
        
        return response()->json(['success' => 'Album order updated successfully']);
    }

    /**
     * Delete a photo
     * @param int $photoId
     * @return Response
     */
    public function deletePhoto($photoId)
    {
        $photo = Photo::findOrFail($photoId);
        
        // Delete the actual file from storage
        Storage::disk('public')->delete(str_replace('/storage/', '', $photo->file_path));
        
        $photo->delete();
        
        return response()->json(['success' => 'Photo deleted successfully']);
    }

    /**
     * Delete an album and all its photos
     * @param int $albumId
     * @return Response
     */
    public function destroyAlbum($albumId)
    {
        $album = Album::findOrFail($albumId);
        
        // Delete all photos in the album
        foreach ($album->photos as $photo) {
            // Delete the actual file from storage
            Storage::disk('public')->delete(str_replace('/storage/', '', $photo->file_path));
            $photo->delete();
        }
        
        // Delete the album
        $album->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Album and all photos deleted successfully'
        ]);
    }

    /**
     * Import menu item images to album
     * @param int $albumId
     * @return Response
     */
    public function importMenuImages($albumId)
    {
        $album = Album::findOrFail($albumId);
        
        // Get all menu items for the current restaurant
        $restaurantId = $this->getRestaurant()->id;
        $categories = \App\Categories::where('company_id', $restaurantId)->get();
        $items = collect();
        
        foreach ($categories as $category) {
            $items = $items->merge($category->items);
        }
        
        $importCount = 0;
        $lastSortOrder = $album->photos()->max('sort_order') ?? 0;
        
        foreach ($items as $key => $item) {
            if (!empty($item->image)) {
                $imageUrl = $item->logom; // Using logom which is the large version
                
                // Create a unique filename
                $filename = time() . '_menu_' . Str::slug($item->name) . '.jpg';
                
                try {
                    // Get the image content
                    $imageContent = file_get_contents($imageUrl);
                    if ($imageContent !== false) {
                        // Store the file
                        Storage::disk('public')->put('photos/' . $filename, $imageContent);
                        
                        // Create photo record
                        $photo = new Photo([
                            'album_id' => $album->id,
                            'file_name' => $filename,
                            'file_path' => '/storage/photos/' . $filename,
                            'title' => $item->name,
                            'sort_order' => $lastSortOrder + $key + 1,
                        ]);
                        
                        $photo->save();
                        $importCount++;
                    }
                } catch (\Exception $e) {
                    \Log::error('Failed to import menu image: ' . $e->getMessage());
                    continue;
                }
            }
        }
        
        return response()->json([
            'success' => true,
            'message' => $importCount . ' images imported successfully'
        ]);
    }
} 