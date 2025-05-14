<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectInformation extends Model
{
    protected $table = 'project_informations'; 
    protected $fillable = [
        'banner_image', 'banner_heading', 'banner_description',
        'description_image', 'description', 'heading', 
        'more_description', 'more_image', 'deleted_by', 'deleted_at'
    ];

    // Add other relationships or methods if needed
}
