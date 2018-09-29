<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
  public function __construct()
  {
    $this->middleware('admin');
  }

  public function store()
  {
    return view('post.store');
  }
}