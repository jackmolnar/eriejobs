@extends('layouts.default')

@section('content')

<div class="profile">

<h1>My Profile</h1>

@if($user->role->title == "Recruiter")
    @include('includes.profiles.recruiter')
@elseif($user->role->title == "Seeker")
    @include('includes.profiles.seeker')
@endif

</div>


@stop