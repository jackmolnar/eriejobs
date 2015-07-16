@extends('layouts.default')

@section('content')

<div class="job_create">

    <div class="col-md-9">
    <h1>Post a new Job Listing</h1>
    <hr/>

{{ Form::open(['action' => 'JobsController@store']) }}

        {{ $hit }}

    @if(isset($job))

        @include('includes.jobs.edit_form')

    @else

        @include('includes.jobs.create_form')

    @endif

        {{-- figure out how to display pricing --}}

        @if($user->subscribed())
            {{ Form::label('length', 'Length of Posting - '.$listingsLeft.' Listings Remaining in Subscription') }}
        @else
            {{ Form::label('length', 'Length of Posting') }}
        @endif
    {{ Form::select('length', $payment, null, ['class' => 'form-control']) }}
    <hr/>

    {{ Form::submit('Continue', ['class' => 'btn btn-primary', 'id' => 'continue_button']) }}
    {{ link_to_action('ProfilesController@index', 'Cancel', null, ['class' => 'btn btn-default']) }}

{{ Form::close() }}

    </div>

    <div class="col-md-3 job_info">

        <div class="well well-primary" data-spy="affix" data-offset-top="10" data-offset-bottom="300">
            <ul>
                <li id="guarantee"><img src="{{ url('images/guarantee.png') }}" alt="5 Application Guarantee" style="max-width: 200px"/><br/><br/>
                    We guarantee our listings! If you don't receive 3 applications when your listing expires, we'll refund you!
                    View the {{ link_to_action('PagesController@getTermsOfGuarantee', 'full terms here.', null, ['target' => '_blank']) }}
                </li>
                <li><img src="{{ URL::asset('images/RapidSSL_SEAL-90x50.gif') }}" /><br/><br/>
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
    Create New Job Listing - EriePaJobs
@stop