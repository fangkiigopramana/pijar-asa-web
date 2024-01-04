<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $primaryKey = 'id'; 
    protected $fillable = ['lesson_id', 'title', 'category', 'description'];

    public function lesson(){
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function submissions(){
        return $this->hasMany(Submission::class, 'id');
    }

    public function images(){
        return $this->hasMany(PostImage::class, 'post_id');
    }
}
