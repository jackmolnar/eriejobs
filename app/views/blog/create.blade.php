@extends('layouts.default')

@section('content')

    <div class="blog col-md-9">

        <h1>Create New Blog Post</h1>

        <hr/>

        {{ Form::open(['action' => 'BlogController@store']) }}

        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) }}
        {{ Form::label('body', 'Body') }}
        {{ Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Title']) }}

        {{ Form::submit('Create Post', ['class' => 'btn btn-primary']) }}

    </div>

@stop

@section('_title')
    Create Blog Post
@stop