@extends('layouts.default')

@section('content')

<div class="browse">

    <div class="col-md-9">
        <div class="well">
            @if(Auth::check())
                @include('includes.notifications.add_search_term')
            @endif
        </div>

    <h1>Browse {{ $category['category']->category }} Jobs</h1>

    <hr/>

        @if(count($category['jobs']))
            @foreach($category['jobs'] as $result)
                @include('includes.jobs.listing')
            @endforeach
        @else
            <h2>We're sorry, there are no jobs currently posted in {{$category['category']->category}} category.</h2>
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
            <!-- Test Ads -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:600px"
                 data-ad-client="ca-pub-5103028415668122"
                 data-ad-slot="7829958692"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        @endif
    </div>



</div>

@stop

@section('_title')
Browse {{ $category['category']->category }} Jobs in Erie Pa - EriePaJobs
@stop

@section('_description')
Browse available {{ $category['category']->category }} jobs in Erie Pennsylvania and Northwestern Pennsylvania at EriePaJobs.
@stop