@extends('layouts.email_template')

@section('content')

    <h2>
        @if(isset($user_name))
            {{ $user_name }},
        @endif
        Confirm you want to reactive your account.
    </h2>
    <hr/>
    <p>To reactivate your account on EriePaJobs:</p>
    <hr/>
    {{ link_to_action('AuthController@restoreUserConfirmed', 'Click This Link', ['user_id' => $user_id]) }}
    <hr/>

@stop

