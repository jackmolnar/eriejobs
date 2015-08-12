@extends('layouts.default')

@section('main_row')

    {{-- Main row --}}
    <div class="hiring_main_row">
        <div class="container">
            <h2>The most affordable recruitment package</h2>
            <h1>in Erie and Northwest Pennsylvania.</h1>
        </div>
    </div>

    <div class="hiring">

        <div class="row general">
            <div class="container">
                <div class="col-md-6">
                    <h3>Now you can recruit in Erie <span class="accent">more affordably than ever before.</span>
                        Save money using EriePaJobs and the Erie Reader to find your next rockstar employee.</h3>
                    <p>
                         Our recruitment packages start at just $250 - and include a 30 day online listing on EriePaJobs and a help wanted ad published in the Erie Reader. This truly is the greatest value for your recruitment dollar!
                    </p>
                    <p>
                        <a href="#signup" class="btn btn-primary btn-lg">Signup Now</a>
                    </p>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/general_icon.png') }}" />
                </div>
            </div>
        </div>

        <div class="row reader">
            <div class="container">
                <div class="col-md-6">
                    <img src="{{ asset('images/reader_icon.png') }}" />
                </div>
                <div class="col-md-6">
                    <h3>Place help wanted ads in the <span class="accent">Erie Reader</span>  - exclusively through EriePaJobs.</h3>
                    <p>
                        All recruitment packages include a print ad to run in the Erie Reader, on a publish date of your choosing. The Erie Reader publishes every other Wednesday, and distributes 12,000 copies to 275 high traffic locations in Erie, Girard, Northeast, and Edinboro.
                        <br/><br/>
                        {{ link_to_action('PagesController@getReaderDates', 'View Upcoming Publish Dates') }}
                    </p>
                    <img src="{{ asset('images/eriereader_logo.png') }}">
                </div>
            </div>
        </div>

        <div class="row indeed">
            <div class="container">
                <div class="col-md-6">
                    <h3>Get your online listing not just posted - but <span class="accent">promoted on national employment website Indeed</span> - completely free.</h3>
                    <p>
                        All EriePaJobs listing are promoted on Indeed. What does that mean? We invest our own money to ensure your listings get premium placement within Indeed search results, driving more applicants to your listing.
                    </p>
                    <img src="{{ asset('images/indeed.png') }}">
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/indeed_promoted_listing_icon.png') }}" />
                </div>
            </div>
        </div>

        <div class="row email">
            <div class="container">
                <div class="col-md-6">
                    <img src="{{ asset('images/email_icon.png') }}" />
                </div>
                <div class="col-md-6">
                    <h3>Your listings get <span class="accent">emailed directly to job seekers</span> in Northwest Pa.</h3>
                    <p>
                        All EriePaJobs listings are emailed directly to nearly 1500 job seekers who have registered with our website. Your listings get delivered directly to the audience who most want to see your help wanted ads.
                    </p>
                    <p>
                        <a href="#signup" class="btn btn-primary btn-lg">Signup Now</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="row social">
            <div class="container">
                <div class="col-md-6">
                    <h3>Listings get shared on our social accounts and <span class="accent">made into ads for more visibility.</span></h3>
                    <p>
                        Your EriePaJobs listing is shared multiple times on all our social accounts. Often shared listings get reshared with job seekers, further pushing your available opportunities in social networks.
                    </p>
                    <p>
                        In addition most listing are made into Facebook ads. We invest our own money in making sure your ads get seen and clicked on in Facebook.
                    </p>
                    <p>
                        <a href="#signup" class="btn btn-primary btn-lg">Signup Now</a>
                    </p>
                </div>

                <div class="col-md-6">
                    <img src="{{ asset('images/social_icon.png') }}" />
                </div>
                {{-- offset to compensate for sticky nav --}}
                <a name="signup"></a>
            </div>
        </div>

        {{-- Signup row --}}
        <div class="row signup">
            <div class="container">
                <div class="col-md-6 col-md-offset-3">
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
    </div>

@stop

@section('_title')
    Recruiter Signup - EriePaJobs
@stop
@section('_description')
    Signup for a free account on EriePaJobs and begin posting help wanted listings. Recruit talent from the Northwestern Pennsylvania region.
@stop