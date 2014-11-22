@extends('layouts.default')

@section('content')

<h1>Profile Page</h1>

@if($user->role->title == "Recruiter")
    <h3>My Active Listings</h3>
    @foreach($user->jobs as $job)
        {{ link_to_action('JobsController@show', $job->title, $job->id) }}
    @endforeach
@endif

@stop