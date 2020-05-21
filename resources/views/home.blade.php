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

                    {{ $msg ?? '' }}

                 <form action="{{ route('p.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="content"> content</label>
                    <textarea class="textarea" name="content" rows="18"></textarea>

                    <div class="col-md-6 d-inline-block">
                      <p>title</p>
                    <input type="text" name="title">
                     <p>syntax</p>
                    <select name="syntax">
                        <option value="JavaScript">JavaScript</option>
                        <option value="HTML">HTML</option>
                        <option value="PHP">PHP</option>
                        <option value="CSS">CSS</option>
                    </select>
                    </div>
                     <div class="col-md-3 d-inline-block">
                       <p>expire</p>
                    <select name="expire">
                        <option value="never">Never</option>
                        <option value="10m">10 Minutes</option>
                        <option value="1h">1 Hour</option>
                        <option value="1d">1 Day</option>
                        <option value="1w">1 Week</option>
                    </select>
                      <p>status</p>
                       @guest
                    <select name="status">
                        <option value="public">Public</option>
                        <option value="unlisted">Unlisted</option>
                    </select>
                    @else
                       <select name="status">
                        <option value="public">Public</option>
                        <option value="unlisted">Unlisted</option>
                        <option value="private">Private</option>
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

          
            
             @guest

             <div class="card" style="width: 18rem;">
              <div class="card-header">
                Recent Public Pastes
              </div>
              <ul class="list-group list-group-flush">
                @foreach($pastes as $paste)
                <li class="list-group-item">
                    <h5><a href="/p/{{$paste->url}}">{{ $paste->title }}</a></h5>
                    <label>{{ $paste->syntax }}</label> <strong>|</strong> <label>  {{ $paste->created_at->diffForHumans() }}</label> 
                </li>

                    @endforeach
              </ul>
            </div>

            @else

              <div class="card mb-3" style="width: 18rem;">
              <div class="card-header">
                My Recent Pastes
              </div>
              <ul class="list-group list-group-flush">
                @foreach($userpastes as $paste)
                <li class="list-group-item">
                  <h5><a href="/p/{{$paste->url}}">{{ $paste->title }}</a></h5>
                <label>Expire:  {{ $paste->expire }}</label> <strong>|</strong> <label>syntax:  {{ $paste->syntax }}</label> 
                </li>

                    @endforeach
              </ul>
            </div>

              <div class="card" style="width: 18rem;">
              <div class="card-header">
                Recent Public Pastes
              </div>
              <ul class="list-group list-group-flush">
                @foreach($pastes as $paste)
                <li class="list-group-item">
                  <h5><a href="/p/{{$paste->url}}">{{ $paste->title }}</a></h5>
                <label>Expire:  {{ $paste->expire }}</label> <strong>|</strong> <label>syntax:  {{ $paste->syntax }}</label> 
                </li>

                    @endforeach
              </ul>
            
            </div>

            @endguest
            <center class="mt-2 mb-2"> <a href="/p"> view all</a></center>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.20.0/prism.min.js"></script>
   



@endsection
