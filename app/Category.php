<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public $fillable= ['name', 'slug'];
    public function posts():HasMany
    {
        return $this->hasMany(Post::class);
    }
}
