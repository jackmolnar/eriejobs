@extends('layouts.default')

@section('content')

<div class="jobs">

    <div class="col-md-9 well">
    <h1>Post a new Job</h1>
    <hr/>

{{ Form::open(['action' => 'JobsController@store']) }}

    {{ Form::label('title', 'Title') }}
    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Job Title']) }}
    {{ Form::label('description', 'Description') }}
    {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Job Description']) }}
    {{ Form::label('salary', 'Salary') }}
    {{ Form::text('salary', null, ['class' => 'form-control half_element', 'placeholder' => 'Salary']) }}

    {{ Form::label('career_level', 'Career Level') }}
    {{ Form::select('career_level', $career_levels, null, ['class' => 'form-control half_element']) }}

    {{ Form::label('type', 'Type') }}
    {{ Form::select('type', $types, null, ['class' => 'form-control half_element']) }}

    {{ Form::label('email', 'Contact Email') }}
    {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}

    {{ Form::label('link', 'Link to Apply Form') }}
    {{ Form::text('link', null, ['class' => 'form-control', 'placeholder' => 'Link']) }}

    {{ Form::label('category', 'Select a Category') }}
    {{ Form::select('category', $categories, null, ['class' => 'form-control']) }}

    {{ Form::label('company_name', 'Company Name') }}
    {{ Form::text('company_name', null, ['class' => 'form-control half_element', 'placeholder' => 'Company Name']) }}
    {{ Form::label('company_address', 'Address') }}
    {{ Form::text('company_address', null, ['class' => 'form-control half_element', 'placeholder' => 'Address']) }}
    {{ Form::label('company_city', 'City') }}
    {{ Form::text('company_city', null, ['class' => 'form-control half_element', 'placeholder' => 'City']) }}
    {{ Form::label('company_state', 'State') }}
    {{ Form::select('company_state', $states, 38, ['class' => 'form-control half_element']) }}

    {{ Form::label('length', 'Length of Posting') }}
    {{ Form::select('length', ['30' => '30 Days', '60' => '60 Days'], null, ['class' => 'form-control']) }}

    {{ Form::submit('Continue', ['class' => 'btn btn-primary', 'id' => 'continue_button']) }}

{{ Form::close() }}

    </div>

</div>
@stop