@extends('layouts.default')

@section('content')
 This is hiring pages.
 {{ link_to_action('AuthController@getRecruiterSignup', 'Signup', null, ['class' => 'btn btn-primary', 'id' => 'recruiter_signup']) }}
@stop
