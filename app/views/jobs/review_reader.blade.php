@extends('layouts.default')

@section('content')

    <div class="jobs">

        <h1 style="display: block; margin-top: 15px;" >Review Your Erie Reader Ad</h1>

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
                    </ul>
                </div>

            </div>
            <hr/>
            <div class="row">
                {{ Form::open(['action' => 'JobsController@payment', 'method' => 'post']) }}

                {{ link_to_action('JobsController@readerCreate', '< Edit Erie Reader Job', null, ['class' => 'btn btn-warning']) }}

                @if(!Config::get('billing.free'))
                    {{ link_to_action('JobsController@cart', 'Continue to Cart >', null, ['class' => 'btn btn-primary']) }}
                @else
                    {{ Form::submit('Post Listing', ['class' => 'btn btn-primary']) }}
                @endif

                {{ Form::close() }}
            </div>
        </div>
        <div class="col-md-3 job_info">
            <div class="well well-primary">
                <ul>
                    <li><img src="{{ URL::asset('images/RapidSSL_SEAL-90x50.gif') }}" /><br/><br/>
                        Our payment processing is secure! We use 256 bit encryption and process all payments through one of the most secure payment gateways in the world, {{ link_to('https://stripe.com/', 'Stripe', ['target' => '_blank']) }}</li>
                    <li>If you have questions or problems, feel free to {{ link_to_action('PagesController@getContact', 'contact us') }}</li>
                </ul>
            </div>
        </div>
    </div>

@stop

@section('scripts')
@stop

@section('_title')
    Review Your Erie Reader Ad - EriePaJobs
@stop

@section('main_row')
    @include('includes.jobs.job_nav')
@stop
