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
            <div class="col-md-12">
                <h1 class="title-{{ $job->id }}">{{ $job->title }}</h1>
                @if(isset($user) && $user->role->title == 'Seeker')
                    @include('includes.jobs.apply_button')
                @elseif(!isset($user))
                    @include('includes.jobs.apply_sign_up_button')
                @endif
                <h3>{{ $job->company_name }}</h3>
            </div>
        </div>
        <hr/>
        <div class="row job_data">
            <div class="col-md-6">
                <ul>
                    <li>{{ Form::label('type', 'Type:') }} {{ $job->type->type }}</li>
                    <li>{{ Form::label('salary', 'Salary:') }} {{ $job->salary }}</li>
                    <li>{{ Form::label('level', 'Career Level:') }} {{ $job->careerlevel->level }}</li>
                    <li>{{ Form::label('category', 'Category:') }}
                        @foreach($job->categories as $category)
                            {{ $category['category'] }}
                        @endforeach
                    </li>

                </ul>
            </div>
            <div class="col-md-6">
                <ul>
                    <li>{{ Form::label('company_address', 'Address:') }} {{ $job->company_address }}</li>
                    <li>{{ Form::label('company_city', 'City:') }} {{ $job->company_city }}</li>
                    <li>{{ Form::label('company_state', 'State:') }} {{ $job->state->title }}</li>
                </ul>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <h3>Job Description</h3>
                {{ $job->description }}
            </div>
        </div>
        @if(isset($user) && $user->role->title == 'Seeker')
            <hr/>
            <div class="row">
                <div class="col-md-12">
                    @include('includes.jobs.apply_button')
                </div>
            </div>
        @endif

    </div>
    <div class="col-md-3">

    </div>

</div>

@if(isset($user) && $user->role->title == 'Recruiter' && $user->id == $job->user_id)
    @include('includes/modals/delete_modal')
@endif

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54a05ff370e9a58d" async="async"></script>

@stop

@section('_title')
{{ $job->title }} - EriePa.Jobs
@stop
@section('_description')
{{ str_limit(strip_tags($job->title.' - '.$job->description), $limit = 200, $end = '...') }}
@stop