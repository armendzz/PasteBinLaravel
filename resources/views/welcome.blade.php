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

            <div class="card mb-3" style="width: 18rem;">
              <div class="card-header">
                My Recent Pastes
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">Cras justo odio</li>
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item">Vestibulum at eros</li>
              </ul>
            </div>
             <div class="card" style="width: 18rem;">
              <div class="card-header">
                Recent Public Pastes
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">Cras justo odio</li>
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item">Vestibulum at eros</li>
              </ul>
            </div>
        </div>
    </div>
</div>





@endsection
