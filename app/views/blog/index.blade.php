@extends('layouts.default')

@section('content')

    <div class="blog col-md-9">

        <h1>All Blog Posts</h1>

        <hr/>

        @if(isset($user) && $user->role->title == 'Administrator')
            {{ link_to_action('BlogController@create', 'Create Post', null, ['class' => 'btn btn-primary btn-sm']) }}
        @endif

        @foreach($posts as $post)
            <div>
                <div class="image col-md-4"></div>
                <div class="text col-md-8">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->description }}</p>
                    <p>{{ link_to_action('BlogController@show', 'Read More', $post->slug, ['class' => 'btn btn-default btn-sm']) }}</p>
                </div>
            </div>
        @endforeach

        @if(!count($posts))
            <h2>Sorry, no blog posts currently available</h2>
        @endif

    </div>

@stop

@section('_title')
    Blog - EriePaJobs
@stop

@section('_description')
    Read about career advice, hiring advice, and the employment picture in Erie and Northwest Pennsylvania.
@stop