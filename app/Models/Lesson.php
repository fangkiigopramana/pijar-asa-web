<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = [''];

    public function teacher(){
        return $this->belongsTo(User::class, 'id');
    }

    public function subscribe(){
        return $this->hasMany(User::class, 'user_id');
    }
    public function posts(){
        return $this->hasMany(Post::class,'lesson_id');
    }


}
