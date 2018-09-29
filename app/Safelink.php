<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Safelink extends Model
{
  protected $fillable = [
  	'url', 'shorten'
  ];

  public function user()
  {
    return $this->belingsTo(User::class);
  }
}