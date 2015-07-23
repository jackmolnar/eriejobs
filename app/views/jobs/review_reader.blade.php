@extends('layouts.default')

@section('content')

    <div class="jobs">

        <h1 style="display: block">Review Your ErieReader Ad</h1>

        <div class="well col-md-9 ">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $pending_reader_job->title }}</h1>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-12">
                    <h3 style="margin-bottom: 25px">Description</h3>
                    {{ $pending_reader_job->description }}
                </div>
            </div>
            <hr/>
            <div class="row location_data">
                <div class="col-md-6">
                    <h3 style="margin-bottom: 25px">Other Details</h3>
                    <ul>
                        <li>{{ Form::label('pubDate', 'Publish Date:') }} {{ $pubDate }}</li>
                        <li>{{ Form::label('heading', 'Heading:') }} {{ $heading }}</li>
                    </ul>
                </div>

            </div>
            <hr/>
            <div class="row">
                {{ Form::open(['action' => 'JobsController@payment', 'method' => 'post']) }}

                {{ link_to_action('JobsController@create', 'Edit Listing', null, ['class' => 'btn btn-warning']) }}

                @if(!Config::get('billing.free'))

                    {{--@if(Session::get('pending_job.setup') == 1)--}}
                    {{-- go to cart --}}
                    {{--{{ link_to_action('JobsController@cart', 'Add Job Listing to Cart', null, ['class' => 'btn btn-primary']) }}--}}
                    {{--@elseif(Session::get('pending_job.setup') == 3)--}}
                    {{-- go to erie reader create--}}
                    {{ link_to_action('JobsController@cart', 'Continue to Cart', null, ['class' => 'btn btn-primary']) }}
                    {{--@endif--}}

                @else
                    {{ Form::submit('Post Listing', ['class' => 'btn btn-primary']) }}
                @endif

                {{ Form::close() }}
            </div>
        </div>
        <div class="col-md-3 job_info">
            <div class="well well-primary">
                <ul>
                    {{--@if($pending_job->email != '')--}}
                    {{--<li id="guarantee"><img src="{{ url('images/guarantee.png') }}" alt="5 Application Guarantee" style="max-width: 200px"/><br/><br/>--}}
                    {{--We guarantee our listings! If you don't receive 3 applications when your listing expires, we'll refund you!--}}
                    {{--View the {{ link_to_action('PagesController@getTermsOfGuarantee', 'full terms here.', null, ['target' => '_blank']) }}--}}
                    {{--</li>--}}
                    {{--@endif--}}

                    <li><img src="{{ URL::asset('images/RapidSSL_SEAL-90x50.gif') }}" /><br/><br/>
                        Our payment processing is secure! We use 256 bit encryption and process all payments through one of the most secure payment gateways in the world, {{ link_to('https://stripe.com/', 'Stripe', ['target' => '_blank']) }}</li>
                    <li>Be sure that the email address or web link that you wish to direct applicants to are valid, or you may not receive applications!</li>
                    <li>If you have questions or problems, feel free to {{ link_to_action('PagesController@getContact', 'contact us') }}</li>
                </ul>
            </div>
        </div>
    </div>

@stop

@section('scripts')
@stop

@section('_title')
    Review Your New Job Listing - EriePaJobs
@stop
