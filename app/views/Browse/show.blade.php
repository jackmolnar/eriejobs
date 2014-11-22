@extends('layouts.default')

@section('content')

<div class="browse">

    <div class="col-md-9">

    <h1>{{ $category['category']->category }} Jobs</h1>

    <hr/>


        @foreach($category['jobs'] as $job)
            <div class="row job_listing">
                <div class="col-md-8">
                    <h4>{{ link_to_action('JobsController@show', $job->title, ['job_id' => $job->id] ) }}</h4>
                    <span class="company_name">{{ $job->company_name }}</span>
                </div>
                <div class="col-md-3">
                    <span class="company_city">{{ $job->company_city }}</span>
                    <span class="posted_date">Posted {{ $job->created_at->diffForHumans() }}</span>
                </div>
            </div>
            <hr/>
        @endforeach

    </div>


</div>

@stop
