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
        <div class="col-md-12 mt-3 mb-2">
           
                <div class="mb-2 mt-2">
                
                 <div class="card">
                  
                     <div class="card-body"> 
                         
                        <div class="media">
                                
                            <img class="mr-3 mb-3 rounded-circle img-fluid"
                                 src="http://paster.manjurulhoque.com/media/avatars/guest.png" alt="avatar"
                                 style=" height: 60px">
                        

                        <div class="media-body">
                            <h5 class="mt-0">
                                <i class="fa fa-paste blue-grey-text small"></i>
                                
                                    <i class="fa fa-clock-o text-warning small"></i>
                                
                                {{ $paste->title }}
                            </h5>
                            <p class="text-muted small">
                                <i class="fa fa-user"></i>
                                
                                    {{ $user->username }}
                                
                                <i class="fa fa-eye ml-2"></i> 2
                                <i class="fa fa-calendar ml-2"> {{ $paste->created_at }} </i>
                                
                            </p>

                            
                        </div>
                        
                       
                        @if ($match)
                        
                         <a href="{{ route('p.edit', $paste->url) }}" class="btn btn-secondary mr-2" ><i class="fa fa-edit"></i> EDIT</a> 
                          <form action="{{ route('p.destroy', $paste->url) }}" method="POST" onSubmit="return confirm('Are You Sure To Delete This Item?')">
                              @csrf
                              @method("DELETE")
                          <button type="submit" class="btn btn-danger mr-2"><i class="fa fa-trash"></i> TRASH</button> 
                          </form>
                                       
                        @endif


                       
                    </div>
                        <div class="card">
                            <div class="card-header">{{ $paste->syntax }} </div>
                            <div class="card-body">
                                
                                <pre class="line-numbers language-{{ $paste->syntax }}" id="pre">
                                    <code class="language-{{ $paste->syntax }}" id="paste_content">
                                        {{ $paste->content }}
                                  </code>
                             </pre>
                               
                            </div>
                        </div>
                  
                        <div class="form-group mt-3 mb-3">
                            <small class="text-muted">To share this paste please copy this url and send to your
                                friends
                            </small>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-info m-0 px-3" id="copy-to-clipboard"
                                            type="button" data-clipboard-target="#url">Copy
                                    </button>
                                </div>
                                <input type="text" class="form-control" value="{{ Request::fullUrl() }}"
                                       readonly id="url">

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">RAW </div>
                            <div class="card-body">
                                
                                <textarea name="" id="" cols="50" rows="20">{{ $paste->content }}</textarea>
                               
                            </div>
                        </div>
                    </div>
                    
                
                 </div>
                
                    

              

            
        </div>
 </div>
    </div>
</div>


   



@endsection
