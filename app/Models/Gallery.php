<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'title', 'description', 'user_id'];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_gallery', 'gallery_id', 'album_id');
    }



}
