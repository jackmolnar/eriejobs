@extends('layouts.default')

@section('content')

@if(Session::has('status'))
    {{ Session::get('status') }}
@endif
@if(Session::has('error'))
    {{ Session::get('error') }}
@endif

<div class="col-lg-6 well">
    <h1>Forgot Password?</h1>
    <hr/>
    <p>
     Enter your email address below and you will receive an email with instructions on how to reset your password.
    </p>
    <hr/>
    {{ Form::open(['action' => 'RemindersController@postRemind']) }}
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
        {{ Form::submit('Send Reminder', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
</div>

@stop