@extends('layouts.default')

@section('content')

    <div class="blog_post col-md-9">
        <div class="col-md-10">
            <h1>{{ $post->title }}</h1>
            <p class="date"><i class="fa fa-calendar"></i> {{ $post->created_at->format('F jS Y') }}</p>
        </div>
        <div class="col-md-2">
            {{ link_to_action('BlogController@index', 'Back To Posts', null, ['class' => 'btn btn-default btn-xs']) }}
            @if(isset($user) && $user->role->title == 'Administrator')
                <div class="admin_buttons">
                    {{ link_to_action('BlogController@edit', 'Edit Post', $post->slug, ['class' => 'btn btn-primary btn-xs']) }}
                </div>
            @endif
        </div>

        <div class="col-md-12 body">
            <img src="{{ asset('images/blog_images/'.$post->image) }}" alt="{{$post->title}}" />
            {{ $post->body }}
        </div>

    </div>
@stop

@section('_title')
    {{ $post->title }} - EriePaJobs
@stop

@section('_description')
    {{ str_limit( strip_tags($post->body), 200, '...') }}
@stop