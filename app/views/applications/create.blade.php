@extends('layouts.default')

@section('content')

    <h1>Apply to the {{ $job->title }} position posted by {{ $job->company_name }}</h1>

    {{ link_to_action('JobsController@show', '< Back to Job Description', $job->id) }}

    {{ Form::open(['action' => ['ApplicationsController@store', $job->id], 'files' => 'true']) }}
        {{ Form::textarea('cover_letter', null, ['class' => 'form-control', 'placeholder' => 'Cover Letter']) }}
        {{ Form::file('resume') }}
        {{ Form::submit('Submit Application', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@stop