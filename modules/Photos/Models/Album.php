<?php

namespace Modules\Photos\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'company_id', 'name', 'slug', 'description', 'is_public', 'sort_order'
    ];

    /**
     * Get the photos for the album.
     */
    public function photos()
    {
        return $this->hasMany(Photo::class)->orderBy('sort_order');
    }
} 