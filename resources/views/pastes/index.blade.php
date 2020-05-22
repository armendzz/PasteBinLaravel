@extends('layouts.app')

@section('content')

<div class="container">

	@if (session('success'))
	<div class="alert alert-success" role="alert">
		{{ session('success') }}
	</div>
	 @endif
	 @if (session('error'))
	 <div class="alert alert-danger" role="alert">
		 {{ session('error') }}
	 </div>
	  @endif
	<div class="col-md-12 border">
		<div class="card mt-3 mb-3"> 
			<div class="card-header">All Public Pastes</div>
			<div class="card-content">
				
				  <ul class="list-group list-group-flush">
					
				  	@foreach($posts as $post)
                <li class="list-group-item">
					@if(auth()->id() === $post->user_id)
						<div class="float-right" >
						
							<a href="{{ route('p.edit', $post->url) }}" class="btn btn-sm btn-secondary mb-2">EDIT</a> 
							 <form action="{{ route('p.destroy', $post->url) }}" method="POST" onSubmit="return confirm('Are You Sure To Delete This Item?')">
								 @csrf
								 @method("DELETE")
							 <button type="submit" class="btn btn-danger btn-sm">TRASH</button> 
							 </form>
							</div>
					
					@endif
                	<h3> <a href="{{ route('p.show', $post->url) }}">{{ $post->title }}</a> </h3>
                <label>Expire:	{{ $post->expire }}</label> <strong>|</strong> <label>syntax:	{{ $post->syntax }}</label> <strong>|</strong> <label>created:	{{ $post->created_at->diffForHumans() }}</label>
					
				
				
                </li>

           			@endforeach
              </ul>
				
			</div>
			
		</div>
		 {{ $posts->links() }}
		
	</div>
</div>
@endsection