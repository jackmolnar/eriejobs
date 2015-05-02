@extends('layouts.default')

@section('content')

<div class="jobs" itemscope itemtype="http://schema.org/JobPosting">

    <div class="well col-md-9 ">
        @if(isset($user) && $user->role->title == 'Recruiter' && $user->id == $job->user_id)
            <div class="btn btn-group edit_buttons">
                {{ link_to_action('JobsController@edit', 'Edit', [$job->id], ['class' => 'btn btn-warning btn-sm']) }}
                <button class="btn btn-danger btn-sm delete_button" data-toggle="modal" data-target="#deleteModal" data-jobid="{{ $job->id }}">Delete</button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <h1 class="title-{{ $job->id }}" itemprop="title">{{ $job->title }}</h1>
                @if(isset($user) && $user->role->title == 'Seeker')
                    @include('includes.jobs.apply_button')
                @elseif(!isset($user))
                    @include('includes.jobs.apply_sign_up_button')
                @endif
                @if($job->confidential)
                    <h3>Confidential</h3>
                @else
                    <h3 itemprop="hiringOrganization">{{ $job->company_name }}</h3>
                @endif
            </div>
        </div>
        <hr/>
        <div class="row job_data">
            <div class="col-md-6">
                <ul>
                    <li >{{ Form::label('type', 'Type:') }} <span itemprop="employmentType">{{ $job->type->type }}</span></li>
                    <li>{{ Form::label('salary', 'Salary:') }} <span itemprop="baseSalary">{{ $job->salary }}</span></li>
                    <li>{{ Form::label('level', 'Career Level:') }} {{ $job->careerlevel->level }}</li>
                    <li>{{ Form::label('category', 'Category:') }}
                        @foreach($job->categories as $category)
                            <span itemprop="industry">{{ $category['category'] }}</span>
                        @endforeach
                    </li>

                </ul>
            </div>
            <div class="col-md-6">
                <ul itemprop="jobLocation">
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
                <span itemprop="responsibilities">{{ $job->description }}</span>
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
    <div class="col-md-3 right_column">
        @if(count($similar_jobs))
            <h3>More Job Openings Like This</h3>
            <hr>
            <ul>
                @foreach($similar_jobs as $similar_job)
                    <li><h4>{{ link_to_action('JobsController@show', $similar_job->title, $similar_job->slug) }}</h4></li>
                @endforeach
            </ul>
            <hr>
        @endif
        @if(count($recruiter_jobs))
            <h3>More Job Openings From This Recruiter</h3>
            <hr>
            <ul>
                @foreach($recruiter_jobs as $recruiter_job)
                    <li><h4>{{ link_to_action('JobsController@show', $recruiter_job->title, $recruiter_job->slug) }}</h4></li>
                @endforeach
            </ul>
            <hr>
        @endif
    </div>

</div>

@if(isset($user) && $user->role->title == 'Recruiter' && $user->id == $job->user_id)
    @include('includes/modals/delete_modal')
@endif

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54a05ff370e9a58d" async="async"></script>

@stop

@section('_title')
{{ $job->title }} - @if(!$job->confidential) {{ $job->company_name }} @endif - Erie Pa Jobs
@stop
@section('_description')
{{ str_limit(strip_tags($job->title.' - '.$job->description), $limit = 200, $end = '...') }}
@stop