<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = [
  	'title', 'body', 'category_id', 'slug'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function category()
  {
    return $this->belongsTo(Category::class);
  }
}