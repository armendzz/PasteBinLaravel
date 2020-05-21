@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-md-12 border">
		<div class="card mt-3 mb-3"> 
			<div class="card-header">All Public Pastes</div>
			<div class="card-content">
				
				  <ul class="list-group list-group-flush">

				  	@foreach($posts as $post)
                <li class="list-group-item">
                	<h3>{{ $post->title }}</h3>
                <label>Expire:	{{ $post->expire }}</label> <strong>|</strong> <label>syntax:	{{ $post->syntax }}</label> <strong>|</strong> <label>created:	{{ $post->created_at }}</label>
                	<div class="float-right" >
					<a href="{{ route('p.edit', $post->id) }}" class="btn btn-secondary mb-2" >EDIT</a> 
                	 <form action="{{ route('p.destroy', $post->id) }}" method="POST" onSubmit="return confirm('Are You Sure To Delete This Item?')">
                	 	@csrf
                	 	@method("DELETE")
                	 <button type="submit" class="btn btn-danger">TRASH</button> 
                	 </form>
                	</div>
                </li>

           			@endforeach
              </ul>
				
			</div>
		</div>
	</div>
</div>
@endsection