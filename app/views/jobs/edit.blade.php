@extends('layouts.default')

@section('content')

<div class="job_create">

    <div class="col-md-9">
    <h1>Edit Your Job Listing</h1>
    <hr/>


{{ Form::model($job, ['action' => ['JobsController@update', $job->id], 'method' => 'put']) }}

    @include('includes.jobs.edit_form')

    <hr/>
    {{ Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'continue_button']) }}
    {{ link_to_action('ProfilesController@index', 'Cancel', null, ['class' => 'btn btn-default']) }}

    {{ Form::close() }}

    </div>

    <div class="col-md-3 well well-primary">
        <ul>
            <li>Be sure that the email address or web link that you wish to direct applicants to are valid, or you may not receive applications!</li>
            <li>If you have questions or problems, feel free to {{ link_to_action('PagesController@getContact', 'contact us') }}</li>
        </ul>
    </div>

</div>
@stop

@section('scripts')
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>

<script>
    tinymce.init({selector:'textarea'});
</script>
@stop

@section('_title')
    Edit Your Job Listing - EriePaJobs
@stop