<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    public function likes()
    {
        return $this->morphMany(like::class,"likeable");
    }

    public function like()
    {
        $like = new like(["user_id" => Auth::id()]);

        $this->likes()->save($like);
    }

    public function unlike()
    {
        $this->likes()->where("user_id", Auth::id())->delete();
    }

    public function toggle()
    {
        return $this->isLiked() ? $this->unlike() : $this->like();
    }

    public function isLiked()
    {
        return !! $this->likes()
                    ->where("user_id", Auth::id())
                    ->count();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
}
