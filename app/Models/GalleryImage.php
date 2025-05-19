<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryImage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'project_id',
        'section1_heading',
        'images',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    // Laravel automatically handles created_at & updated_at
}
