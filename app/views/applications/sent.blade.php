@extends('layouts.default')

@section('content')

    <div class="jobs col-md-9">
        <h1>Your Application for {{ $job->title }} Has Been Sent!</h1>

        <hr/>

        <p>
            You should hear back from {{ $job->company_name }} soon! In the meantime {{ link_to_action('SearchController@index', 'check out') }} other career opportunities and apply for other positions.
        </p>
    </div>

@stop

@section('_title')
    Application for {{ $job->title }} Sent - EriePaJobs
@stop