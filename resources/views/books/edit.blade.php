@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Edit Book</h3></div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/books/edit/' . $book->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="title" class="col-md-2 control-label">Title</label>

                            <div class="col-md-5">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $book->title }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('author') ? 'has-error' : '' }}">
                            <label for="author" class="col-md-2 control-label">Author</label>

                            <div class="col-md-5">
                                <select id="author" name="author">
                                    @foreach ($authors as $author)
                                        @if ($book->author->id == $author->id)
                                            <option value="{{ $author->id }}" selected>{{ $author->name }}</option>
                                        @else
                                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('author'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('author') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
                            <label for="tags" class="col-md-2 control-label">Tags</label>

                            <div class="col-md-5">
                                <select id="tags" name="tags[]" multiple>
                                    @foreach ($tags as $tag)
                                        @if ($book->ids_tags->contains($tag->id))
                                            <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                                        @else
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('tags'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description" class="col-md-2 control-label">Description</label>

                            <div class="col-md-5">
                                <textarea id="description" class="form-control" name="description" required>{{ $book->description }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-5">

                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('/books') }}" class="btn">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
