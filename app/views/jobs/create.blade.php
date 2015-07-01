@extends('layouts.default')

@section('content')

<div class="job_create">

    <div class="col-md-9">
    <h1>Post a new Job</h1>
    <hr/>

{{ Form::open(['action' => 'JobsController@store']) }}

    @if(isset($job))

        @include('includes.jobs.edit_form')

        {{ Form::label('length', 'Length of Posting') }}
        {{ Form::select('length', $payment, null, ['class' => 'form-control']) }}
        <hr/>

        {{ Form::submit('Continue', ['class' => 'btn btn-primary', 'id' => 'continue_button']) }}
        {{ link_to_action('ProfilesController@index', 'Cancel', null, ['class' => 'btn btn-default']) }}

    @else

        @include('includes.jobs.create_form')

        {{ Form::label('length', 'Length of Posting') }}
        {{ Form::select('length', $payment, null, ['class' => 'form-control']) }}
        <hr/>

        {{ Form::submit('Continue', ['class' => 'btn btn-primary', 'id' => 'continue_button']) }}
        {{ link_to_action('ProfilesController@index', 'Cancel', null, ['class' => 'btn btn-default']) }}
    @endif

{{ Form::close() }}

    </div>

    <div class="col-md-3">

        <div class="well well-primary">
            <ul>
                <li>EriePaJobs is secure! We use 256 bit encryption and one of the safest payment gateways in the world.</li>
                <li>Be sure that the email address or web link that you wish to direct applicants to are valid, or you may not receive applications!</li>
                <li>If you have questions or problems, feel free to {{ link_to_action('PagesController@getContact', 'contact us') }}</li>
            </ul>
        </div>

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
    Create New Job Listing - EriePaJobs
@stop