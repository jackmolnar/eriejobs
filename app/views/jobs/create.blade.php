@extends('layouts.default')

@section('content')

<div class="job_create">

    <div class="col-md-9">
    <h1>Post a new Job</h1>
    <hr/>

{{ Form::open(['action' => 'JobsController@store']) }}

    @if(isset($job))
        @include('includes.jobs.edit_form')
    @else
        @include('includes.jobs.create_form')
    @endif

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