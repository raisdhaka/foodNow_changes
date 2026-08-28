<?php

namespace Modules\Photos\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'album_id', 'file_name', 'file_path', 'title', 'description', 'sort_order'
    ];

    /**
     * Get the album that owns the photo.
     */
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
} 