@extends('layouts.email_template')

@section('content')

    <h2>New Erie Reader Ad</h2>
    <hr/>
    <p>
        <b>Job Title:</b> {{ $job_title }}
    </p>
    <p>
        <b>Job Description: </b><br/>
        {{ $job_description }}
    </p>
    <p>
        <b>Publish Date:</b> {{ $publish_date }}
    </p>
@stop
