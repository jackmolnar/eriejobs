@extends('layouts.default')

@section('content')

    <div class="blog col-md-9">

        <h1>All Blog Posts</h1>

        <hr/>

        @if(isset($user) && $user->role->title == 'Administrator')
            <div class="admin_buttons">
                {{ link_to_action('BlogController@create', 'Create Post', null, ['class' => 'btn btn-primary btn-xs']) }}
            </div>
        @endif

        @foreach($posts as $post)
            <div class="col-md-12 blog_post_listing">
                <div class="image col-md-4">
                    <img src="{{ asset('images/blog_images/thumb_'.$post->image) }}" />
                </div>
                <div class="text col-md-8">
                    <h2 class="title">{{ link_to_action('BlogController@show', $post->title, $post->slug ) }}</h2>
                    <p class="date"><i class="fa fa-calendar"></i> {{ $post->created_at->format('F jS Y') }}</p>
                    <p class="description">
                        {{ str_limit( strip_tags($post->body), 150, '...') }}
                    </p>
                    {{ link_to_action('BlogController@show', 'Read More', $post->slug, ['class' => 'btn btn-default btn-xs']) }}
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