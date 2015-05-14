@extends('layouts.default')


@section('content')
<div class="login">
    <div class="col-lg-6 well">
        <h1>Please Login</h1>
        <hr/>
        {{ Form::open(['action' => 'AuthController@postLogin']) }}
        {{ Form::label('email', 'Email') }}
        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
        <label>
            {{ Form::checkbox('remember', 1) }} Remember Me
        </label>
        <br/>
        <br/>
        {{ Form::submit('Login', ['class' => 'btn btn-primary', 'id' => 'login']) }}
        {{ Form::close() }}
        <hr/>
        <h2>Login With</h2>
        <hr/>
        <div class="row social_buttons">
            <a href="{{ route('social-login', array('facebook')) }}?onsuccess=/profile&onerror=/login" class="btn btn-primary"><i class="fa fa-facebook-square"></i> Facebook</a>
            &nbsp;
            <a href="{{ route('social-login', array('linkedin')) }}?onsuccess=/profile&onerror=/login" class="btn btn-primary"><i class="fa fa-linkedin-square"></i> LinkedIn</a>
        </div>
        <hr/>
        <div class="pass_reset">Forgot your password? {{ link_to_action('RemindersController@getRemind', 'Reset it here.') }}</div>
    </div>

    <div class="col-md-6">
        @if(Agent::isMobile())
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- mobile banner -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:320px;height:100px"
                 data-ad-client="ca-pub-5103028415668122"
                 data-ad-slot="3467674298"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        @else
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Test Ads -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:600px"
                 data-ad-client="ca-pub-5103028415668122"
                 data-ad-slot="7829958692"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        @endif
    </div>

</div>
@stop

@section('_title')
EriePaJobs - Login
@stop
@section('_description')
Login to EriePaJobs and search for jobs, apply for jobs, and post job listings.
@stop
