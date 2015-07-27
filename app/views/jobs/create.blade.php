@extends('layouts.default')

@section('content')

<div class="job_create">

    <div class="col-md-9">
    <h1>Create EriePaJobs Listing</h1>
    <hr/>

{{ Form::open(['action' => 'JobsController@store']) }}

    @if(isset($job))

        @include('includes.jobs.edit_form')

    @else

        @include('includes.jobs.create_form')

    @endif

        {{-- length of listing --}}
        {{ Form::hidden('length', 30) }}

    <hr/>

    {{ Form::submit('Review Your EriePaJobs Listing >', ['class' => 'btn btn-primary', 'id' => 'continue_button', 'style' => 'float:right']) }}
    {{ link_to_action('ProfilesController@index', 'Cancel', null, ['class' => 'btn btn-default']) }}

{{ Form::close() }}

    </div>

    <div class="col-md-3 job_info">
        <div class="well well-primary" data-spy="affix" data-offset-top="10" data-offset-bottom="300">
            <ul>
                <li><img src="{{ URL::asset('images/RapidSSL_SEAL-90x50.gif') }}" /><br/><br/>
                    <img src="{{ URL::asset('images/stripe.png') }}" /><br/><br/>
                    EriePaJobs is secure! We use 256 bit encryption and process all payments through one of the most secure payment gateways in the world, {{ link_to('https://stripe.com/', 'Stripe', ['target' => '_blank']) }}</li>

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
    Create New EriePaJobs Listing - EriePaJobs
@stop

@section('main_row')
    @include('includes.jobs.job_nav')
@stop