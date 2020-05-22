<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Pastes\CreatePastesRequest;
use App\Http\Requests\Pastes\UpdatePasteRequest;
use App\Post;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Session;


//use App\Http\UpdatePastesRequest;


class PastesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       
        
       return view('pastes.index')->with('posts', Post::where('status', '=', 'public')->latest()->simplePaginate(3));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePastesRequest $request)
    {
      $unurl = Str::random(11);
      $user = auth()->id() ?: '0';
        $paste = Post::create([
            
          // dd($user)
           
             'title' => $request->input('title') ?: 'untitled',
            'content' => $request->content,
            'syntax' => $request->syntax,
            'expire' => $request->expire,
            'status' => $request->status,
            'url' => $unurl,
            'user_id' => $user

        ]);

        session()->flash('success', 'Paste Created Successfully.');
          // dd($paste->toArray()['url']);
        return redirect(route('p.show', $paste->toArray()['url']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
       
               
        //-$paste = Post::find($url);
        $paste = Post::where('url', '=', $url)->get();
        $paste1 = $paste[0]->toArray();
        $object = (object) $paste1;
        $match = ($paste[0]->toArray()['user_id'] === auth()->id());

        if ($object->user_id === 0){
            $user = (object)[];
            $user->username = 'anonymus'; 
        } else {
            $user = User::find($object->user_id);
        } 
        if ($paste1['status'] === 'private'){
            if ($match){
                return view('pastes.show')->with('paste', $object)->with('user', $user)->with('match', $match);
            } else {
                session()->flash('error', 'This is a private Paste.');

                return redirect(route('home'));
            }
        } else {
           return view('pastes.show')->with('paste', $object)->with('user', $user)->with('match', $match);
        }
        
       

    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($url)
    {
        $paste = Post::where('url', '=', $url)->get();
        $paste1 = $paste[0]->toArray();
        $match = ($paste[0]->toArray()['user_id'] === auth()->id());

       
        if (Auth::check()) {
        if ($match){
            $object = (object) $paste1;
            return view('pastes.edit')->with('paste', $object);
        } else {
            session()->flash('success', 'You are not authorized to edit someones else pastes.');
            return back();
        }
        } else {
            session()->flash('success', 'You are not authorized for this action.');
          
            return back();
        }  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePasteRequest $request, $url)
    {


        $data = $request->only(['title', 'content', 'syntax', 'expire', 'status']);
        $paste = Post::where('url', '=', $url)->get();
        $paste1 = $paste[0];
        $match = ($paste[0]->toArray()['user_id'] === auth()->id());
      
        if (Auth::check()) {
            if ($match){

        $paste1->update($data);
        return redirect(route('p.index')); }
        else {
            session()->flash('success', 'You are not authorized to edit someones else pastes.');
            return back();
        }
        } else {
            session()->flash('success', 'You are not authorized for this action.');
          
            return back();
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($url)
    {
        $paste = Post::where('url', '=', $url)->get();
        $paste1 = $paste[0];
        $paste11 = $paste[0]->toArray();
        $userid = $paste11['user_id'];
        $useridd = auth()->id();
        if (Auth::check()) {
            if ($userid === $useridd){
           
            $paste1 ->forceDelete(); 
            session()->flash('success', 'Paste deleted Successfully.');
        } else {
            session()->flash('success', 'You are not authorized to delte someones else pastes.');
            return back();
        }
        return redirect(route('p.index')); 
        } else {
            session()->flash('success', 'You are not authorized for this action.');
            return back();
        }
    }
}
