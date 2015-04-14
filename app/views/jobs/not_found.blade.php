@extends('layouts.default')

@section('content')
    <div class="alert alert-danger">
        <h2>Job Listing Not Found</h2>
        <hr/>
        <p>Sorry, the listing you are trying to view is no longer active or has been deleted.</p>
        <p>You can look for other listings {{ link_to_action('SearchController@index', 'here.') }}</p>
    </div>
@stop

@section('_title')
    Job Listing Not Found - Erie Pa Jobs
@stop
@section('_description')
    Job listing was not found.
@stop
