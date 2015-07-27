@extends('layouts.default')

@section('content')

<div class="jobs">

    <h1 style="display: block">Review Your EriePaJobs Listing</h1>

    <div class="well col-md-9 ">
        <div class="row">
            <h1 style="margin-top: 15px">{{ $pending_job->title }}</h1>
            <hr/>
            <h3>{{ $pending_job->company_name }}</h3>
        </div>
        <hr/>
        <div class="row job_data">
            <ul>
                <li>{{ Form::label('type', 'Type:') }} {{ $pending_job->type->type }}</li>
                <li>{{ Form::label('salary', 'Salary:') }} {{ $pending_job->salary }}</li>
                <li>{{ Form::label('level', 'Career Level:') }} {{ $pending_job->careerlevel->level }}</li>
                <li>{{ Form::label('category', 'Category:') }} {{ $categories[$pending_job->category_id] }}</li>
            </ul>
        </div>
        <hr/>
        <div class="row">
            <h3 style="margin-bottom: 25px">Job Description</h3>
            {{ $pending_job->description }}
        </div>
        <hr/>
        <div class="row location_data">
            <div class="col-md-6">
                <h3 style="margin-bottom: 25px">Location</h3>
                <ul>
                    <li>{{ Form::label('company_address', 'Address:') }} {{ $pending_job->company_address }}</li>
                    <li>{{ Form::label('company_city', 'City:') }} {{ $pending_job->company_city }}</li>
                    <li>{{ Form::label('company_state', 'State:') }} {{ $pending_job->state->title }}</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h3 style="margin-bottom: 25px">Contact and Length</h3>
                <ul>
                    @if($pending_job->email != '')
                        <li>
                            {{ Form::label('email', 'Email Address Applications Should Be Sent To:') }}
                            <br/>
                            {{ $pending_job->email }}
                        </li>
                    @elseif($pending_job->link != '')
                        <li>
                            {{ Form::label('link', 'Link Applicants Should Be Directed To:') }}
                            <br/>
                            {{ $pending_job->link }}
                        </li>
                    @endif
                    <li>
                        {{ Form::label('expire', 'Listing Will Expire On:') }}
                         <br/>
                         {{ $pending_job->expire->toDayDateTimeString() }}
                    </li>
                    <li>
                        {{ Form::label('confidential', 'Confidential Listing?') }}
                        <br/>
                        @if($pending_job->confidential)
                            Yes
                        @else
                            No
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <hr/>
        <div class="row">
            {{ Form::open(['action' => 'JobsController@payment', 'method' => 'post']) }}

                {{ link_to_action('JobsController@create', '< Edit Listing', null, ['class' => 'btn btn-warning']) }}

                @if(!Config::get('billing.free'))
                        {{ link_to_action('JobsController@readerCreate', 'Create Your Erie Reader Ad > ', null, ['class' => 'btn btn-primary']) }}
                @else
                    {{ Form::submit('Post Listing', ['class' => 'btn btn-primary']) }}
                @endif

            {{ Form::close() }}
        </div>
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
@stop

@section('_title')
Review Your EriePaJobs Listing - EriePaJobs
@stop

@section('main_row')
    @include('includes.jobs.job_nav')
@stop
