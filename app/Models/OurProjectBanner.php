<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurProjectBanner extends Model
{
    use SoftDeletes;

    protected $table = 'our_project_banners';

    protected $fillable = [
        'banner_heading',
        'banner_image',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
