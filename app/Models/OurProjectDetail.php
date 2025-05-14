<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurProjectDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'banner_image',
        'project_image',
        'project_heading',
        'slug',
        'title',
        'location',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function category()
    {
        return $this->belongsTo(OurProjectCategory::class, 'category_id');
    }
}
