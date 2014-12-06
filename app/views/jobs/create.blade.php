@extends('layouts.default')

@section('content')

<div class="job_create">

    <div class="col-md-9">
    <h1>Post a new Job</h1>
    <hr/>

{{ Form::open(['action' => 'JobsController@store']) }}

    {{ Form::label('title', 'Title', ['class' => 'required']) }}
    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Job Title']) }}
    {{ Form::label('description', 'Description', ['class' => 'required']) }}
    {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Job Description']) }}
    <hr/>

    <div class="row">
        <div class="col-md-6">
            {{ Form::label('salary', 'Salary') }}
            {{ Form::text('salary', null, ['class' => 'form-control half_element', 'placeholder' => 'Salary']) }}

            {{ Form::label('type', 'Type', ['class' => 'required']) }}
            {{ Form::select('type', $types, null, ['class' => 'form-control half_element']) }}
        </div>

        <div class="col-md-6">
            {{ Form::label('career_level', 'Career Level', ['class' => 'required']) }}
            {{ Form::select('career_level', $career_levels, null, ['class' => 'form-control half_element']) }}
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-12">
        <h4>How would you like to receive applications?</h4>
        </div>
        <div class="col-md-6">
        <div class="radio">
            <label>
                {{ Form::radio('contact', 'email', false, ['id' => 'email_contact']) }}
                Send applications to an email address.
            </label>
        </div>
        <div class="radio">
            <label>
                {{ Form::radio('contact', 'link', false, ['id' => 'link_contact']) }}
                Applicants should be directed to a webpage.
            </label>
        </div>
        </div>
        <div class="col-md-6">
            <span class="apply"></span>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6">
            {{ Form::label('company_name', 'Company Name', ['class' => 'required']) }}
            {{ Form::text('company_name', null, ['class' => 'form-control half_element', 'placeholder' => 'Company Name']) }}
            {{ Form::label('company_address', 'Address') }}
            {{ Form::text('company_address', null, ['class' => 'form-control half_element', 'placeholder' => 'Address']) }}
            <div class="checkbox" id="confidential">
                <label>
                    {{ Form::checkbox('confidential', 1, false, ['id' => 'confidential']) }}
                    Do you want to post this listing confidentially?
                </label>
            </div>
        </div>
        <div class="col-md-6">
            {{ Form::label('company_city', 'City', ['class' => 'required']) }}
            {{ Form::text('company_city', null, ['class' => 'form-control half_element', 'placeholder' => 'City']) }}
            {{ Form::label('company_state', 'State', ['class' => 'required']) }}
            {{ Form::select('company_state', $states, 38, ['class' => 'form-control half_element']) }}
        </div>
    </div>
    <hr/>
    {{ Form::label('category', 'Select a Category', ['class' => 'required']) }}
    {{ Form::select('category', $categories, null, ['class' => 'form-control']) }}


    {{ Form::label('length', 'Length of Posting') }}
    {{ Form::select('length', ['30' => '30 Days', '60' => '60 Days'], null, ['class' => 'form-control']) }}

    {{ Form::submit('Continue', ['class' => 'btn btn-primary', 'id' => 'continue_button']) }}

{{ Form::close() }}

    </div>

    <div class="col-md-3 well well-primary">
        60 Day Listing $125
    </div>

</div>
@stop