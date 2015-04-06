@extends('layouts.default')

@section('content')

    <div class="blog col-md-9">

        <h1>Create New Blog Post</h1>

        <hr/>

        {{ Form::open(array('action' => 'BlogController@store', 'files' => true)) }}

        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) }}

        {{ Form::label('slug', 'Slug') }}
        {{ Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Slug']) }}

        {{ Form::label('body', 'Body') }}
        {{ Form::textarea('body', null, ['class' => 'form-control', 'id' => 'body_content', 'placeholder' => 'Body']) }}

        <hr/>

        {{ Form::label('image', 'Main Image') }}
        {{ Form::file('image') }}

        <hr/>

        {{ Form::submit('Create Post', ['class' => 'btn btn-primary']) }}

    </div>

@stop

@section('_title')
    Create Blog Post
@stop

@section('scripts')
    <script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'body_content' );
    </script>
@stop
