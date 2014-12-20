@extends('layouts.default')

@section('content')

<div class="job_create">

    <div class="col-md-9">
    <h1>Edit Your Job Listing</h1>
    <hr/>

{{ Form::model($job, ['action' => ['JobsController@update', $job->id], 'method' => 'put']) }}

    @include('includes.jobs.edit_form')

{{ Form::close() }}

    </div>

    <div class="col-md-3 well well-primary">
        60 Day Listing $125
    </div>

</div>
@stop

@section('scripts')
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>

<script>
    tinymce.init({selector:'textarea'});
</script>
@stop