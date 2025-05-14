<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // ✅ Correct import

class OurProjectCategory extends Model
{



    use SoftDeletes;

    protected $fillable = [
        'category_name',
        'slug',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];
}




