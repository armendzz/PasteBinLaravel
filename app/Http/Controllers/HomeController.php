<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->id();
        $userpaste = Post::where('user_id', '=', $user)->latest()->take(5)->get();
        
        
       


        $paste = Post::where('status', '=', 'public')->latest()->take(5)->get();
      // dd(auth()->id());
         return view('home')->with('pastes', $paste)->with('userpastes', $userpaste);
    }


    public function home()
    {
         
        $user = auth()->id();
        $userpaste = Post::where('user_id', '=', $user)->latest()->get();

        return view('auth.profile')->with('posts', $userpaste);

    }
}
