<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable =['content', 'user_id'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
