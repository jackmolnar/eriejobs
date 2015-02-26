@extends('layouts.default')

@section('content')


    <div class="col-md-9 application">

        <h1>Apply to the {{ $job->title }} Position</h1>
        <h3>posted by {{ $job->company_name }}</h3>

        <hr/>

        {{ Form::open(['action' => ['ApplicationsController@store', $job->id], 'files' => 'true']) }}

            <p>Include your cover letter below or a short introduction.</p>
            {{ Form::textarea('cover_letter', null, ['class' => 'form-control', 'placeholder' => 'Cover Letter']) }}

            <hr/>

            @if($user->filename)
                <div class="radio">
                    <label>
                        <input type="radio" name="resume_radio_group" id="default_resume" value="default_resume" >
                        Would you like to use the resume you have on file? - {{ $user->filename }}
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="resume_radio_group" id="new_resume" value="new_resume" >
                        Or would you like to upload a different resume?
                    </label>
                </div>

                <div id="new_resume_upload"></div>
            @else
                <p>Attach your resume. Files must be PDF or Word files and smaller than 6mb in size.</p>
                {{ Form::file('resume') }}
            @endif

            <hr/>

            <div class="apply_buttons">
                {{ Form::submit('Submit Application', ['class' => 'btn btn-primary']) }}
                {{ link_to_action('JobsController@show', 'Cancel', $job->id, ['class' => 'btn btn-default']) }}
            </div>

            <div class="loader"></div>

        {{ Form::close() }}

    </div>

@stop

@section('_title')
    Apply to the {{ $job->title }} Position - EriePa.Jobs
@stop