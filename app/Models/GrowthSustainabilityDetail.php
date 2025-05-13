<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrowthSustainabilityDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'thumbnail_image',
        'heading',
        'title',
        'sustainability_title',
        'sustainability_image',
        'sustainability_description',
        'created_by',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_by',
        'deleted_by',
    ];
}

