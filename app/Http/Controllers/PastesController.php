<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Pastes\CreatePastesRequest;
use App\Http\Requests\Pastes\UpdatePastesRequest;
use App\Post;
use Illuminate\Database\Eloquent\SoftDeletes;


class PastesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pastes.index')->with('posts', Post::all());

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
         
      
        Post::create([

            'title' => $request->input('title') ?: 'untitled',
            'content' => $request->content,
            'syntax' => $request->syntax,
            'expire' => $request->expire,
            'status' => $request->status

        ]);

        session()->flash('success', 'Paste Created Successfully.');

        return redirect(route('p.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return view('pastes.index')->with('posts', Post::all());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paste = Post::find($id);
        return view('pastes.edit')->with('paste', $paste);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePastesRequest $request, $id)
    {
        $data = $request->only(['title', 'content', 'syntax', 'expire', 'status']);

        $paste->update($data);
        return redirect(route('p.index')); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
      $paste = Post::find($id);
      $paste ->forceDelete(); 
      

        session()->flash('success', 'Paste deleted Successfully.');

        return redirect(route('p.index')); 

        
    }
}
