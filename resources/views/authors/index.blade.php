@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Authors</div>

                <div class="panel-body">
                    <a href="{{ url('/authors/add') }}" class="btn btn-primary">Add Author</a>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (!count($authors))
                        <p class="no-items">Add your first author.</p>
                    @endif
                </div>

                @if (count($authors))
                	<div class="table-responsive">
	                    <table class="table table-striped">
	                        <thead>
	                        	<tr>
	                        		<th>Name</th>
	                        		<th>Description</th>
	                        		<th width="170">Actions</th>
	                        	</tr>
	                        </thead>

	                        <tbody>
	                        	@foreach ($authors as $author)
	                        		<tr>
	                        			<td>{{ $author->name }}</td>
	                        			<td>{{ $author->description }}</td>
	                        			<td>
                                            <div class="btn-group">
    	                        				<a href="{{ url('/authors/edit/' . $author->id) }}" class="btn btn-sm btn-default">Edit</a>
    	                        				<a href="{{ url('/authors/delete/' . $author->id) }}" class="delete-btn btn btn-sm btn-danger">Delete</a>
                                            </div>
	                        			</td>
	                        		</tr>
	                        	@endforeach
	                        </tbody>
	                    </table>
                	</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
