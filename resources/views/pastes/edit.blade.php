@extends('layouts.app')

@section('content')

<style type="text/css">
    textarea
{
  width:100%;
}
</style>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 mt-3 mb-2 border">
           
                <div class="mb-2 mt-2">
                
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                 <form action="{{ route('p.update', $paste->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label for="content"> content</label>
                    <textarea class="textarea" name="content" rows="18">{{ $paste->content }}</textarea>
                    <p>{{ $paste->syntax }}
                    <div class="col-md-6 d-inline-block">
                      <p>title</p>
                    <input type="text" name="title" value="{{ $paste->title }}">
                     <p>syntax</p>
                    <select name="syntax">
                        <option value="HTML" {{($paste->syntax === 'HTML') ? 'Selected' : ''}}>HTML</option>
                        <option value="Javascript" {{($paste->syntax === 'JavaScript') ? 'Selected' : ''}}>JavaScript</option>
                        <option value="PHP" {{($paste->syntax === 'PHP') ? 'Selected' : ''}}>PHP</option>
                        <option value="CSS" {{($paste->syntax === 'CSS') ? 'Selected' : ''}}>CSS</option>
                    </select>
                    </div>
                     <div class="col-md-3 d-inline-block">
                       <p>expire</p>
                    <select name="expire">
                        <option value="Never" {{($paste->expire === 'Never') ? 'Selected' : ''}}>Never</option>
                        <option value="10m" {{($paste->expire === '10m') ? 'Selected' : ''}}>10 Minutes</option>
                        <option value="1h" {{($paste->expire === '1h') ? 'Selected' : ''}}>1 Hour</option>
                        <option value="1d" {{($paste->expire === '1d') ? 'Selected' : ''}}>1 Day</option>
                        <option value="1w" {{($paste->expire === '1w') ? 'Selected' : ''}}>1 Week</option>
                    </select>
                      <p>status</p>
                       @guest
                    <select name="status">
                        <option value="public">Public</option>
                        <option value="unlisted">Unlisted</option>
                    </select>
                    @else
                       <select name="status">
                        <option value="public" {{($paste->status === 'public') ? 'Selected' : ''}}>Public</option>
                        <option value="unlisted" {{($paste->status === 'unlisted') ? 'Selected' : ''}}>Unlisted</option>
                        <option value="private" {{($paste->status === 'private') ? 'Selected' : ''}}>Private</option>
                    </select>
                    @endguest

                    

              </div>

             <div class="col-md-3 mt-3">
                    <button type="submit" class="btn btn-primary">Paste +</button> 
                </div>

                </form>
        </div>
 </div>
        <div class="col-md-3 mt-3">

          
            sidebar
           
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.20.0/prism.min.js"></script>
   



@endsection
