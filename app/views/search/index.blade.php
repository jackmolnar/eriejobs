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

    </div>

    <div class="col-md-3">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Test Ads -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:300px;height:600px"
             data-ad-client="ca-pub-5103028415668122"
             data-ad-slot="7829958692"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
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