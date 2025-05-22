<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConnectivityDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'project_id',
        'section1_heading',
        'section1_description',
        'section2_headings',
        'section2_svgs',
        'section2_project_titles',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $dates = ['deleted_at'];
}
