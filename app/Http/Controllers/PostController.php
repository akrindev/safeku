<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class PostController extends Controller
{
  public function __construct()
  {
    $this->middleware('admin')->except(['show']);
  }

  public function show($slug)
  {
    $data = Post::whereSlug($slug)->first();


    return view('post.read', compact('data'));
  }

  public function store()
  {
    if(request()->isMethod('post'))
    {
      $slug = str_slug(request('title')).'-'.str_random(5);

      auth()->user()->post()->create([
      	'title'	=> request("title"),
        'slug'	=> $slug,
        'body'	=> request("body"),
        'category_id'	=> request("category"),
      ]);

      return response()->json([
        'success'=>true,
        'slug'=> $slug
      ]);
    }

    return view('post.store');
  }

  public function storeCategory()
  {
    Category::create([
    	'name'	=> request('name'),
    ]);

    return response()->json(['success'=>true]);
  }
}