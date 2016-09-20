@extends('layouts.app')

@section('content')
<div id="modal-rent" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/books/rent/_id_') }}">
                {{ csrf_field() }}

                <div class="modal-body">
                    <div class="form-group">
                        <label for="from" class="col-md-2 control-label">From</label>

                        <div class="col-md-5">
                            <input id="from" type="text" class="form-control datepicker" name="from" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="to" class="col-md-2 control-label">To</label>

                        <div class="col-md-5">
                            <input id="to" type="text" class="form-control datepicker" name="to" value="" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Rent</button>
                    <div class="btn btn-default" data-dismiss="modal">Close</div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Books</h3></div>

                <div class="panel-body">
                    <a href="{{ url('/books/add') }}" class="btn btn-primary">Add Book</a>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (!count($books))
                        <p class="no-items">Add your first book.</p>
                    @endif
                </div>

                @if (count($books))
                	<div class="table-responsive">
	                    <table class="table table-striped">
	                        <thead>
	                        	<tr>
                                    <th width="125">Cover</th>
                                    <th width="150">Title</th>
                                    <th width="130">Author</th>
	                        		<th width="120">Tags</th>
	                        		<th>Description</th>
	                        		<th width="230" class="text-center">Actions</th>
	                        	</tr>
	                        </thead>

	                        <tbody>
	                        	@foreach ($books as $book)
	                        		@if ($book->rented)
                                        <tr class="success">
                                    @else
                                        <tr>
                                    @endif
                                        <td>
                                            <img src="{{ $book->coverURL() }}" width="100" alt="cover" />
                                        </td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author->name }}</td>
	                        			<td>
                                            @foreach ($book->tags as $tag)
                                                @if ($loop->last)
                                                    {{ $tag->name }}
                                                @else
                                                    {{ $tag->name . ', ' }}
                                                @endif
                                            @endforeach
                                        </td>
	                        			<td>{{ $book->description }}</td>
	                        			<td class="text-center">
                                            <div class="btn-group">
    	                        				<a href="{{ url('/books/edit/' . $book->id) }}" class="btn btn-sm btn-default">Edit</a>
                                                @if ($book->rented)
                                                    <a href="{{ url('/books/unrent/' . $book->id) }}" class="btn btn-sm btn-primary">Cancel rent</a>
                                                @else
                                                    <a href="#" class="rent-btn btn btn-sm btn-primary" data-title="{{ $book->title }}" data-id="{{ $book->id }}">Rent</a>
                                                @endif
                                                <a href="{{ url('/books/delete/' . $book->id) }}" class="delete-btn btn btn-sm btn-danger">Delete</a>
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
