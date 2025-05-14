<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurProjectDetail extends Model
{
    use HasFactory, SoftDeletes;

    // The attributes that are mass assignable.
    protected $fillable = [
        'project_heading',
        'title', // Add title here
        'slug',
        'location',
        'banner_image',
        'project_image',
        'category_id',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    // Relation with the category (One-to-Many inverse relationship)
    public function category()
    {
        return $this->belongsTo(OurProjectCategory::class, 'category_id');
    }

    // Created By relationship with User (assuming user model is available)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Updated By relationship with User (assuming user model is available)
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Deleted By relationship with User (assuming user model is available)
    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
