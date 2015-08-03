@extends('layouts.default')

@section('main_row')

    {{-- Main row --}}
    <div class="hiring_main_row">
        <div class="container">
            <h2>Looking for the right employee?</h2>
            <h1>You've come to the right place.</h1>
        </div>
    </div>

    <div class="hiring">

        {{-- Signup row --}}
        <div class="signup ">
            <div class="container">
                <div class="col-md-6 left_column">
                    <h1 class="hiring_headline"><span class="accent">The most affordable recruitment package in Northwest Pennsylvania.</span></h1>
                    <hr/>
                    <p>
                        EriePaJobs is the only employment website exclusive to the Erie and Northwestern Pennsylvania region. We are dedicated to helping employers find the candidates they need to fill their open job opportunities.
                    </p>
                    <ul>
                        <li>
                            All recruiting packages include a 30 day online listing on EriePaJobs and a help wanted ad in the Erie Reader.
                            <img src="http://www.eriereader.com/uploads/layout/erie-reader-logo-2014.png" alt="Erie Reader" style="max-width: 300px; margin-top: 15px; margin-bottom: 15px; display: block; margin-left: auto; margin-right: auto;" />
                            Your Erie Reader ad will appear in all 12,000 copies that are distributed in over 275 high traffic locations throughout Erie
                        </li>
                        <li>EriePaJobs advertises throughout the region to make sure your listings get the visibility you require</li>
                        <li>All listings posted on the site are shared on our Facebook, Twitter, and LinkedIn pages several times</li>
                        <li>Listings are emailed and text messaged to nearly 1500 subscribed job seekers in Erie</li>
                        <li>Your Erie Reader ad will appear in all 12,000 copies that are distributed in over 275 high traffic locations throughout Erie.</li>
                        <li>
                            Help wanted ads are also promoted on Indeed.com for more exposure<br/>
                            <img src="{{ url('images/indeed.png') }}" alt="Indeed Erie Pa" style="margin-top: 15px;   display: block; margin-left: auto; margin-right: auto;"/>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="well">
                        <h2>Signup and Start Recruiting</h2>
                        <hr/>

                        {{ Form::open(['action' => 'AuthController@postRecruiterSignup']) }}
                        <div class="row">
                            <div class="col-md-6">
                                {{ Form::label('email', 'Email', ['class' => 'required']) }}
                                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
                                {{ Form::label('first_name', 'First Name', ['class' => 'required']) }}
                                {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name']) }}
                                {{ Form::label('last_name', 'Last Name', ['class' => 'required']) }}
                                {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('password', 'Password', ['class' => 'required']) }}
                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
                                {{ Form::label('password', 'Re-Enter Password', ['class' => 'required']) }}
                                {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="font-size: 12px;">
                                By signing up you agree to our {{ link_to_action('PagesController@getTermsOfUse', 'terms of use.', null, ['target' => '_blank']) }}
                            </div>
                        </div>
                        <hr/>
                        {{ Form::submit('Subscribe', ['class' => 'btn btn-primary btn-sm']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

        {{-- erie reader row --}}

        {{--<div class="row pricing">--}}
            {{--<div class="container">--}}
                {{--<div class="col-md-12"><h2>Pricing</h2></div>--}}
                {{--<div class="col-md-6">--}}
                    {{--<div class="price_box">--}}
                        {{--<h3>30 Day Listing<br/>--}}
                            {{--Just $119--}}
                        {{--</h3>--}}
                        {{--<ul>--}}
                            {{--<li>Cheaper Than Monster and LinkedIn</li>--}}
                            {{--<li>Listings Also Promoted on Indeed.com</li>--}}
                            {{--<li>Emailed and Text Messaged to Subscribers</li>--}}
                            {{--<li>3 Application Guarantee</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-6">--}}
                    {{--<div class="price_box">--}}
                        {{--<h3>60 Day Listing<br/>--}}
                            {{--Just $149</h3>--}}
                        {{--<ul>--}}
                            {{--<li>Cheaper Than Monster and LinkedIn</li>--}}
                            {{--<li>Listings Also Promoted on Indeed.com</li>--}}
                            {{--<li>Emailed and Text Messaged to Subscribers</li>--}}
                            {{--<li>3 Application Guarantee</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

    </div>

@stop

@section('_title')
    Recruiter Signup - EriePaJobs
@stop
@section('_description')
    Signup for a free account on EriePaJobs and begin posting help wanted listings. Recruit talent from the Northwestern Pennsylvania region.
@stop