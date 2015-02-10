@extends('layouts.default')

@section('content')
    <div class="container hiring">

        <div class="col-md-6 left_column">
            <h1 class="hiring_headline"><span class="accent">Job Listings Are <span class="free">Free</span><br> For The First 90 Days Of Our Launch!</span></h1>
            <hr/>
            <p>
                EriePa.Jobs is the only employment website exclusive to the Northwestern Pennsylvania region. We are dedicated to helping employers find the candidates they need to fill their open job opportunities.
            </p>
            <ul>
                <li>EriePa.Jobs advertises throughout the region to make sure your listings get the visibility you require</li>
                <li>All listings posted on the site are shared on our Facebook, Twitter, and LinkedIn pages</li>
                <li>Listings are emailed to users who have requested to be notified when new jobs are posted that fit their qualifications</li>
            </ul>

            <hr/>

            <h1 class="hiring_headline">Don't wait, <span class="free">sign up</span> and start recruiting!</h1>
        </div>


        <div class="col-md-6 well">

            <h2>Recruiter Signup</h2>

            <hr/>

            {{ Form::open(['action' => 'AuthController@postRecruiterSignup']) }}
            <div class="row">
                <div class="col-md-6">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
                    {{ Form::label('first_name', 'First Name') }}
                    {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name']) }}
                    {{ Form::label('last_name', 'Last Name') }}
                    {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) }}
                </div>
                <div class="col-md-6">
                    {{ Form::label('password', 'Password') }}
                    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
                    {{ Form::label('password', 'Re-Enter Password') }}
                    {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) }}
                </div>
            </div>
            <hr/>
                {{ Form::submit('Subscribe', ['class' => 'btn btn-primary btn-sm']) }}
            {{ Form::close() }}

        </div>


    </div>

@stop

@section('main_row')
    <div class="hiring_main_row">
        <div class="container">
            <h2>Looking for the right employee?</h2>
            <h1>You've come to the right place.</h1>
        </div>
    </div>
@stop

@section('_title')
    Recruiter Signup - EriePa.Jobs
@stop
@section('_description')
    Signup for a free account on EriePa.Jobs and begin posting help wanted listings. Recruit talent from the Northwestern Pennsylvania region.
@stop