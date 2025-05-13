<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestimonialsDetails extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'person_name',
        'designation',
        'rating',
        'token_name',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}

