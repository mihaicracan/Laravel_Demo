@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Tags</div>

                <div class="panel-body">
                    <a href="{{ url('/tags/add') }}" class="btn btn-primary">Add Tag</a>

                    @if (session('success'))
                        <div class="alert alert-success">
                            Tag added.
                        </div>
                    @endif

                    @if (!count($tags))
                        <p class="no-items">No tag added.</p>
                    @endif
                </div>

                @if (count($tags))
                	<div class="table-responsive">
	                    <table class="table table-striped">
	                        <thead>
	                        	<tr>
	                        		<th>Name</th>
	                        		<th>Description</th>
	                        		<th>Actions</th>
	                        	</tr>
	                        </thead>

	                        <tbody>
	                        	@foreach ($tags as $tag)
	                        		<tr>
	                        			<td>{{ $tag->name }}</td>
	                        			<td>{{ $tag->description }}</td>
	                        			<td>
	                        				<a href="{{ url('/tags/edit/' . $tag->id) }}">Edit</a>
	                        				<a href="{{ url('/tags/delete/' . $tag->id) }}">Delete</a>
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
