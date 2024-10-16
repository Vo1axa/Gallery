<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
    {
        use HasFactory;
    
        protected $fillable = ['name', 'title', 'cover_image', 'user_id'];
    
        // Relasi many-to-many dengan Gallery
        public function galleries()
        {
            return $this->belongsToMany(Gallery::class, 'album_gallery', 'album_id', 'gallery_id');
        }
        
    
        // Relasi belongsTo ke User
        public function user()
        {
            return $this->belongsTo(User::class);
        }
    }
    