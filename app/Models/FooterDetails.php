<?php

// app/Models/FooterDetails.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'address',
        'url',
        'contact_number',
        'about',
        'social_media',
        'deleted_by',
        'deleted_at',


        'email',
        'address',
        'url',
        'contact_number',
        'about',
        'social_media',
        'deleted_by',
        'deleted_at',
    ];

    protected $casts = [
        'social_media' => 'array',
        'deleted_at' => 'datetime',
    ];
}
