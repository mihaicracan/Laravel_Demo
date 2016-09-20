@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Tags</h3></div>

                <div class="panel-body">
                    <a href="{{ url('/tags/add') }}" class="btn btn-primary">Add Tag</a>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (!count($tags))
                        <p class="no-items">Add your first tag.</p>
                    @endif
                </div>

                @if (count($tags))
                	<div class="table-responsive">
	                    <table class="table table-striped">
	                        <thead>
	                        	<tr>
	                        		<th width="150">Name</th>
	                        		<th>Description</th>
	                        		<th width="170" class="text-center">Actions</th>
	                        	</tr>
	                        </thead>

	                        <tbody>
	                        	@foreach ($tags as $tag)
	                        		<tr>
	                        			<td>{{ $tag->name }}</td>
	                        			<td>{{ $tag->description }}</td>
	                        			<td class="text-center">
                                            <div class="btn-group">
    	                        				<a href="{{ url('/tags/edit/' . $tag->id) }}" class="btn btn-sm btn-default">Edit</a>
    	                        				<a href="{{ url('/tags/delete/' . $tag->id) }}" class="delete-btn btn btn-sm btn-danger">Delete</a>
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
