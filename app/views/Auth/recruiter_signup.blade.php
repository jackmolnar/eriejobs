@extends('layouts.default')

@section('content')

    <div class="row">
        <h1>Recruiter Signup</h1>
    </div>

    <div class="row">
        {{ Form::submit('Signup With Linkedin', ['class' => 'btn btn-primary btn-lg']) }}
    </div>

    {{ Form::open(['action' => 'AuthController@postRecruiterSignup']) }}
    <div class="row">
        <div class="col-md-4">
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
            {{ Form::label('first_name', 'First Name') }}
            {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name']) }}
            {{ Form::label('last_name', 'Last Name') }}
            {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) }}
        </div>
        <div class="col-md-4">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
            {{ Form::label('password', 'Re-Enter Password') }}
            {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) }}
            <div class="email_notifications">
                Receive Email Notifications about Career Opportunities
                {{ Form::label('notifications', 'Yes') }}
                {{ Form::checkbox('notifications', 1, 1) }}
            </div>
        </div>
    </div>
    <div class="row">
        {{ Form::submit('Subscribe', ['class' => 'btn btn-primary btn-sm']) }}
    </div>
    {{ Form::close() }}
@stop