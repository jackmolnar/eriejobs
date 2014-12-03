@extends('layouts.default')

@section('content')

<div class="search">

    <div class="col-md-9">

    @include('includes.search.search_form')

    @if($term != '')
        <h1>Results for "{{ $term }}"</h1>
    @else
        <h1>All Jobs</h1>
    @endif

    <hr/>

    @foreach($results as $result)
        <div class="row job_listing">
            <div class="col-md-8">
                <h4>{{ link_to_action('JobsController@show', $result->title, ['job_id' => $result->id] ) }}</h4>
                <span class="company_name">{{ $result->company_name }}</span>
            </div>
            <div class="col-md-3">
                <span class="company_city">{{ $result->company_city }}</span>
                <span class="posted_date">Posted {{ $result->created_at->diffForHumans() }}</span>
            </div>
        </div>
        <hr/>
    @endforeach

    </div>
    <div class="pagination_links">
        {{ $results->links() }}
    </div>

</div>

@stop