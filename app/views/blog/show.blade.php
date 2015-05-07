@extends('layouts.default')

@section('content')

    <div class="blog_post col-md-9">

        <div class="col-md-9">
            <h1>{{ $post->title }}</h1>
            <p class="date"><i class="fa fa-calendar"></i> {{ $post->created_at->format('F jS Y') }}</p>
            <span class='st_facebook_vcount' displayText='Facebook'></span>
            <span class='st_twitter_vcount' displayText='Tweet'></span>
            <span class='st_linkedin_vcount' displayText='LinkedIn'></span>
            <span class='st_googleplus_vcount' displayText='Google +'></span>
            <span class='st_email_vcount' displayText='Email'></span>
        </div>
        <div class="col-md-2">
            {{ link_to_action('BlogController@index', 'Back To Posts', null, ['class' => 'btn btn-default btn-xs posts_back_button']) }}
            @if(isset($user) && $user->role->title == 'Administrator')
                <div class="admin_buttons">
                    {{ link_to_action('BlogController@edit', 'Edit Post', $post->slug, ['class' => 'btn btn-primary btn-xs']) }}
                </div>
            @endif
        </div>

        <div class="col-md-12 body">
            <img src="{{ asset('images/blog_images/'.$post->image) }}" alt="{{$post->title}}" class="img-responsive" />
            {{ $post->body }}
        </div>

        @if(!isset($user))
            @include('includes.blog.signup_prompt')
        @endif

    </div>
    <div class="col-md-3">
        {{-- Get recent job listings --}}
        @include('includes.blog.recent_jobs')
    </div>


    <script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({publisher: "dc971248-c84a-475a-9b16-e8927be4f6bc", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
@stop

@section('_title')
    {{ $post->title }} - EriePaJobs
@stop

@section('_description')
    {{ str_limit( strip_tags($post->body), 200, '...') }}
@stop