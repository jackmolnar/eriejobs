@extends('layouts.default')

@section('content')

    <div class="col-md-9">

        <h1>Apply to the {{ $job->title }} Position</h1>
        <h3>posted by {{ $job->company_name }}</h3>

        <hr/>

        <p>
            Include your cover letter below or a short introduction.
        </p>

        {{ Form::open(['action' => ['ApplicationsController@store', $job->id], 'files' => 'true']) }}
        {{ Form::textarea('cover_letter', null, ['class' => 'form-control', 'placeholder' => 'Cover Letter']) }}
        <hr/>
        <p>
            Browse for and attach your resume. Files must be PDF or Word files and smaller than 6mb in size.
        </p>


        {{ Form::file('resume') }}
        <hr/>
        {{ Form::submit('Submit Application', ['class' => 'btn btn-primary']) }}
        {{ link_to_action('JobsController@show', 'Cancel', $job->id, ['class' => 'btn btn-default']) }}
        {{ Form::close() }}

    </div>

@stop

@section('_title')
    Apply to the {{ $job->title }} Position - EriePa.Jobs
@stop