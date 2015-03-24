@extends('layouts.default')

@section('content')

<div class="profile">

    <div class="col-md-12">
        <h1>My Profile</h1>
    </div>

    @if($user->role->title == "Recruiter")
        @include('includes.profiles.recruiter')
    @elseif($user->role->title == "Seeker")
        @include('includes.profiles.seeker')
    @endif

</div>

@include('includes.ga_tracking.new_account_vp')
@include('includes.ga_tracking.login_event')

@stop

@section('scripts')
@stop

@section('_title')
   {{ $user->first_name }} {{ $user->last_name }}'s Profile - EriePaJobs
@stop