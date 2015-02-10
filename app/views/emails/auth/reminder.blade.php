@extends('layouts.email_template')

@section('content')

<h2>
    @if(isset($user))
        {{ $user['first_name'] }},
    @endif
    Reset Your Password
</h2>
<hr/>
<p>To reset your password:</p>
<hr/>
@if(isset($token))
    <a href="{{ URL::to('password/reset', array($token)) }}">Click This Link</a>
    <br/><br/>
    or copy the link below and paste in your browser
    <br/><br/>
    {{ URL::to('password/reset', array($token)) }}
@endif
<hr/>
<p>
This link will expire in {{ Config::get('auth.reminder.expire', 60) }} minutes.
</p>

@stop

