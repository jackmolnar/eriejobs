@extends('...layouts.default')

@section('content')

<div class="profile">

    <h1>Edit Your Info</h1>

    <div class="col-md-9 ">

        <div class="well edit_info">
            {{ Form::model($user, ['action' => ['ProfilesController@update_info', $user->id], 'method' => 'put']) }}

                {{ Form::label('first_name', 'First Name') }}
                {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name']) }}
                {{ Form::label('last_name', 'Last Name') }}
                {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) }}
                {{ Form::label('email', 'Email Address') }}
                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}

                {{ Form::submit('Update', ['class' => 'btn btn-primary btn-sm']) }}

                {{ link_to_action('ProfilesController@index', 'Cancel', null, ['class' => 'btn btn-default btn-sm']) }}

            {{ Form::close() }}
        </div>

    </div>

</div>
@stop

@section('_title')
    Edit {{ $user->first_name }} {{ $user->last_name }}'s Profile Information - EriePa.Jobs
@stop