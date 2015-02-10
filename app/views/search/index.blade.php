@extends('layouts.default')

@section('content')

<div class="search">

    <div class="col-md-9">

        <div class="well">
            @include('includes.search.search_form')
        </div>

        @if($term != '')
            <h1>Results for "{{ $term }}"</h1>
        @else
            <h1>All Jobs</h1>
        @endif

    <hr/>

    @if(isset($noResults))
        <div class="row job_listing"><h2>{{ $noResults }}</h2></div>
    @endif

    @if(isset($results))
        @foreach($results as $result)
            @include('includes.jobs.listing')
        @endforeach
        </div>
        <div class="pagination_links">
            {{ $results->links() }}
        </div>
    @endif


</div>
</div>

@stop

@section('_title')
    @if(isset($term) and $term != '')
        Search Results for "{{$term}}" - EriePa.Jobs
    @else
        Search Results for All Jobs
    @endif
@stop