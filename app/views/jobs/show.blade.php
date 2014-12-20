@extends('layouts.default')

@section('content')

<div class="jobs">

    <div class="well col-md-9 ">
        @if(isset($user) && $user->role->title == 'Recruiter' && $user->id == $job->user_id)
            <div class="btn btn-group edit_buttons">
                {{ link_to_action('JobsController@edit', 'Edit', [$job->id], ['class' => 'btn btn-warning btn-sm']) }}
                <button class="btn btn-danger btn-sm delete_button" data-toggle="modal" data-target="#deleteModal" data-jobid="{{ $job->id }}">Delete</button>
            </div>
        @endif

        <div class="row">
            <h1 class="title-{{ $job->id }}">{{ $job->title }}</h1>
            <hr/>
            <h3>{{ $job->company_name }}</h3>
        </div>
        <hr/>
        <div class="row job_data">
            <ul>
                <li>Type: {{ $job->type->type }}</li>
                <li>Salary: {{ $job->salary }}</li>
                <li>Career Level: {{ $job->careerlevel->level }}</li>
            </ul>
        </div>
        <hr/>
        <div class="row">
            <h3>Job Description</h3>
            {{ $job->description }}
        </div>
        @if(isset($user) && $user->role->title == 'Seeker')
            <hr/>
            <div class="row">
                @if($job->email != '')
                    {{ link_to_action('ApplicationsController@create', 'Apply', [$job->id], ['class' => 'btn btn-primary']) }}
                @elseif($job->link != '')
                    {{ link_to($job->link, 'Apply', ['class' => 'btn btn-primary']) }}
                @endif
            </div>
        @endif

    </div>
    <div class="col-md-3">

    </div>

</div>

@if(isset($user) && $user->role->title == 'Recruiter' && $user->id == $job->user_id)
    @include('includes/modals/delete_modal')
@endif

@stop