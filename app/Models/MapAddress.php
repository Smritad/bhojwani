<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MapAddress extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'project_id',
        'heading',
        'map_url',
        'site_title',
        'site_address',
        
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
