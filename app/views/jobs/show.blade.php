@extends('layouts.default')

@section('content')

<div class="jobs">

    <div class="well col-md-9 ">
        <h1>{{ $job->title }}</h1>
        <hr/>
        <h2>{{ $job->company_name }}</h2>
        <ul>
            <li>Type: {{ $job->type->type }}</li>
            <li>Salary: {{ $job->salary }}</li>
            <li>Career Level: {{ $job->careerlevel->level }}</li>
        </ul>
        <h2>Job Description</h2>
        {{ $job->description }}
        @if($job->email != '')
            {{ link_to_action('ApplicationsController@create', 'Apply', [$job->id], ['class' => 'btn btn-primary']) }}
        @elseif($job->link != '')
            {{ link_to($job->link, 'Apply', ['class' => 'btn btn-primary']) }}
        @endif
    </div>
    <div class="col-md-3">

    </div>

</div>
@stop