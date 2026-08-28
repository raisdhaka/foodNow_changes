<?php

namespace Modules\Poscloud\Entities;

use Illuminate\Database\Eloquent\Model;

class AiOrder extends Model
{
    protected $guarded = [];

    protected $casts = [
        'processed' => 'boolean'
    ];

    /**
     * Get the company that owns the AI order.
     */
    public function company()
    {
        return $this->belongsTo(\App\Restorant::class, 'company_id');
    }
} 