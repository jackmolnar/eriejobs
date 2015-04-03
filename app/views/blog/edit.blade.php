@extends('layouts.default')

@section('content')

    <div class="blog edit_blog col-md-9">

        <h1>Edit Blog Post</h1>

        <hr/>

        {{ Form::model($post, ['action' => ['BlogController@update', $post->slug], 'method' => 'put', 'files' => true]) }}


        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) }}

        {{ Form::label('slug', 'Slug') }}
        {{ Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Slug']) }}

        {{ Form::label('body', 'Body') }}
        {{ Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Body']) }}

        <hr/>

        <h3>Current Image</h3>

        <img src="{{ asset('images/blog_images/'.$post->image) }}" class="current_image"/>

        <h3>Upload Replacement Image</h3>

        {{ Form::label('image', 'Main Image') }}
        {{ Form::file('image') }}

        <hr/>

        {{ Form::submit('Save Post', ['class' => 'btn btn-primary']) }}

    </div>

@stop

@section('_title')
    Edit Blog Post
@stop

@section('scripts')
    <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>

    <script>
        tinymce.init({selector:'textarea'});
    </script>
@stop
