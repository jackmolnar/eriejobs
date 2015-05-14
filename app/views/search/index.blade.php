@extends('layouts.default')

@section('content')

<div class="search">

    <div class="col-md-9">

        <div class="well">
            @include('includes.search.search_form')
        </div>

        @include('includes.jobs.pagination')

        @if($term != '')
            <h1>Results for "{{ $term }}"</h1>
        @else
            <h1>All Jobs</h1>
        @endif

    <hr/>

    @if(isset($noResults))
        <div class="job_listing"><p>{{ $noResults }}</p></div>
    @endif

    @if(isset($results))
        @foreach($results as $result)
            @include('includes.jobs.listing')
        @endforeach
    @endif

    @include('includes.jobs.pagination')

        @if(Agent::isDesktop())
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- leaderboard -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:728px;height:90px"
                 data-ad-client="ca-pub-5103028415668122"
                 data-ad-slot="6141939094"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        @endif

    </div>

    <div class="col-md-3">
        @if(Agent::isMobile())
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- mobile banner -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:320px;height:100px"
                 data-ad-client="ca-pub-5103028415668122"
                 data-ad-slot="3467674298"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        @else
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- medium rectangle -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:250px"
                 data-ad-client="ca-pub-5103028415668122"
                 data-ad-slot="1292937099"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        @endif

        <div class="well blog_posts">
            <h2>Recent Blog Posts</h2>
            <hr/>
            @foreach($posts as $post)
                <h3>{{ link_to_action('BlogController@show', $post->title, $post->slug) }}</h3>
                <div class="blog_image" style="background-image: url( {{ asset('images/blog_images/'.$post->image) }} )"></div>
                <p>{{ strip_tags(str_limit($post->body, 100, '...')) }}
                    <br/>{{ link_to_action('BlogController@show', 'Read More >', $post->slug) }}</p>
            @endforeach
        </div>

        @if(Agent::isDesktop())
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- medium rectangle -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:250px"
                 data-ad-client="ca-pub-5103028415668122"
                 data-ad-slot="1292937099"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        @endif








    </div>

</div>

@stop

@section('_title')
    @if(isset($term) and $term != '')
        Search Results for "{{$term}}" - EriePaJobs
    @else
        Search Results for All Jobs
    @endif
@stop