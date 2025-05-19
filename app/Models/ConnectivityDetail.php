<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConnectivityDetail extends Model
{
    protected $fillable = [
        'project_id',
        'section1_heading',
        'section1_description',
        'section2_icons',
        'section2_headings',
        'section2_project_titles',
        'section2_project_matters',
    ];
}
