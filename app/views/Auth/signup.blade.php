@extends('layouts.default')

@section('content')

<div class="signup well col-md-8">

    <h2>Sign Up With</h2>
    <hr/>
    <div class="row social_buttons">
        <a href="{{ route('social-login', array('facebook')) }}?onsuccess=/profile&onerror=/login" class="btn btn-primary btn-lg"><i class="fa fa-facebook-square"></i> Facebook</a>
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
    <div class="row">
        <div class="col-md-4">
            {{ Form::submit('Subscribe', ['class' => 'btn btn-primary btn-md']) }}
        </div>
    </div>
    {{ Form::close() }}

</div>



@stop

