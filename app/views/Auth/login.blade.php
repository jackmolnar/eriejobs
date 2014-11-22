@extends('layouts.default')

@section('content')
<div class="login">
    <div class="row">
        <div class="col-lg-6 well">
            <h1>Please Login</h1>
            <hr/>
            {{ Form::open(['action' => 'AuthController@postSeekerLogin']) }}
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
            {{ Form::submit('Login', ['class' => 'btn btn-primary', 'id' => 'login']) }}
            {{ Form::close() }}
            <hr/>
            <h2>Login With</h2>
            <hr/>
            <div class="row social_buttons">
                <a href="{{ route('social-login', array('facebook')) }}?onsuccess=/profile&onerror=/login" class="btn btn-primary"><i class="fa fa-facebook-square"></i> Facebook</a>
            </div>
            <hr/>
            <div class="pass_reset">Forgot your password? {{ link_to_action('RemindersController@getRemind', 'Reset it here.') }}</div>
        </div>
    </div>
</div>
@stop