@extends('layouts.default')

@section('content')

<div class="job_create">

    <div class="col-md-9">
    <h1>Post a new Job Listing</h1>
    <hr/>

{{ Form::open(['action' => 'JobsController@store']) }}

    @if(isset($job))

        @include('includes.jobs.edit_form')

    @else

        @include('includes.jobs.create_form')

    @endif

        {{-- figure out how to display pricing --}}

    {{ Form::label('length', 'Length of Posting - If you have subscribed, you might pay nothing. Find out after added to the cart.') }}
    {{ Form::select('length', $payment, null, ['class' => 'form-control']) }}
    <hr/>

    {{ Form::submit('Continue', ['class' => 'btn btn-primary', 'id' => 'continue_button']) }}
    {{ link_to_action('ProfilesController@index', 'Cancel', null, ['class' => 'btn btn-default']) }}

{{ Form::close() }}

    </div>

    <div class="col-md-3">

        <div class="well well-primary">
            <ul>
                <li>Our payment processing is secure! We use 256 bit encryption and process all payments through one of the most secure payment gateways in the world, {{ link_to('https://stripe.com/', 'Stripe', ['target' => '_blank']) }}</li>
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