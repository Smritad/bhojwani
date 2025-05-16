<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectAmenity extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'banner_image', 'description', 'thumbnail_images',
        'headings', 'titles', 'created_by', 'updated_by', 'deleted_by'
    ];
}
