@extends('layouts.default')

@section('content')

<div class="col-md-12">
    <div class="alert alert-info">Looking to hire? {{ link_to_action('PagesController@hiring', 'Signup for a recruiter account!') }}</div>
</div>

<div class="signup col-md-6">

    <h1 class="signup_headline">Signup for a <span class="accent">free</span> account and begin searching for your next career opportunity!</h1>

    <hr/>

    <p>
    EriePa.Jobs is the only employment website exclusive to the Northwestern Pennsylvania region. We are dedicated to helping match job seekers with area employers.
    </p>

    <ul>
        <li>Search for job opportunities posted by Northwestern Pennsylvania employers</li>
        <li>Apply for job openings</li>
        <li>Sign up to receive email notifications for jobs that interest you</li>
        <li>Follow our social accounts and get updated about new job listings</li>
    </ul>
</div>


<div class=" signup col-md-6">
    <div class="well">
        <h2>Sign Up With</h2>
        <hr/>
        <div class="row social_buttons">
            <a href="{{ route('social-login', array('facebook')) }}?onsuccess=/profile&onerror=/login" class="btn btn-primary"><i class="fa fa-facebook-square"></i> Facebook</a>
            &nbsp;
            <a href="{{ route('social-login', array('linkedin')) }}?onsuccess=/profile&onerror=/login" class="btn btn-primary"><i class="fa fa-linkedin-square"></i> LinkedIn</a>
        </div>
        <hr/>
        <h2>Or Fill Out the Form</h2>

        <hr/>

        {{ Form::open(['action' => 'AuthController@postSeekerSignup']) }}
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
                <div class="email_notifications">
                    {{ Form::checkbox('notifications', 1, 1) }}
                    Receive Email Notifications about Career Opportunities
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-4">
                {{ Form::submit('Subscribe', ['class' => 'btn btn-primary btn-md']) }}
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>


@stop

@section('main_row')
    <div class="seeker_signup_main_row">
        <div class="container">
            <h2>Looking for the right career opportunity?</h2>
            <h1>You've come to the right place.</h1>
        </div>
    </div>
@stop

@section('_title')
    Job Seeker Signup - EriePa.Jobs
@stop
@section('_description')
    Signup for a free account on EriePa.Jobs and begin searching and browsing our help wanted listings as well as apply for career opportunities.
@stop