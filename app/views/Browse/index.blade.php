@extends('layouts.default')

@section('content')

<div class="browse">

    <div class="well">
        <h1>Choose a Category to Browse</h1>

        <hr/>

        <ul class="categoryList">
            @foreach($categories as $category)
                <li>
                    {{ link_to_action('BrowseController@show', $category['category'], [$category['slug']] ) }}
                    @if($category['job_count'] > 0)
                        <span class="badge">{{ $category['job_count'] }}</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <div>
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




</div>

@stop

@section('_title')
Browse Jobs in Erie and Northwestern Pennsylvania - EriePaJobs
@stop

@section('_description')
Browse available jobs in Erie Pennsylvania and Northwestern Pennsylvania at EriePaJobs.com.
@stop