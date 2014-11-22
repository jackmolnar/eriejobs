@extends('layouts.default')

@section('content')

<div class="col-lg-6 well">
    <h1>Reset Password</h1>
    <hr/>
    {{ Form::open(['action' => 'RemindersController@postReset']) }}
        {{ Form::hidden('token', $token) }}
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
        {{ Form::label('password', 'New Password') }}
        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Email']) }}
        {{ Form::label('password_confirmation', 'Confirm New Password') }}
        {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Email']) }}
        {{ Form::submit('Reset Password', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
</div>

@stop
