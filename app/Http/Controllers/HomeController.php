<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Safelink;
use App\Category;

class HomeController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $links = auth()->user()->safelink()->latest()->take(5)->get();
    $posts = auth()->user()->post()->latest()->paginate(6);

    return view('sudo.home', compact('links', 'posts'));
  }

  public function shorten()
  {
    $validator = Validator::make(request()->all(),[
    	'url'	=> 'required'
    ]);

    $response = [
    	'success'	=> false,
        'errors' => $validator->errors()->all()
    ];

    if($validator->fails())
    {
      return response()->json($response);
    }

    $shorten = str_random(10);
    $short = Safelink::whereShorten($shorten)->first();

    if(! $short)
    {
      $short = auth()->user()->safelink()->create([
      	'url'		=> request("url"),
       	'shorten'	=> $shorten
      ]);
    }


    return response()->json(['success'	=> true, 'shorten' => url('/?v=' . $short->shorten)]);
  }


  public function fetchCategory()
  {
    $categories = Category::get();

    return response()->json($categories);
  }
}