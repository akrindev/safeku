<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Safelink;

class HomeController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    return view('sudo.home');
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

    $having = true;

    while($having)
    {
      $shorten = str_random(10);
      $short = Safelink::whereShorten($shorten)->first();

      if(! $short)
      {
        auth()->user()->safelink()->create([
        	'url'		=> request("url"),
          	'shorten'	=> $shorten
        ]);

        $having = false;
        break;
      }
    }

    return response()->json(['success'	=> true, 'shorten' => url('/?v=' . $shorten)]);
  }

}