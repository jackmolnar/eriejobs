@extends('...layouts.default')

@section('content')

<div class="profile">

    <h1>Edit Your Notifications</h1>

    <div class="col-md-9 ">

        <div class="well edit_info">

            <h4>Check the email notifications you wish to no longer receive and click delete.</h4>

            <hr/>

            {{ Form::open(['action' => ['ProfilesController@update_notifications', $user->id], 'method' => 'put']) }}

                @foreach($user->jobNotifications as $notification)
                    <p>
                        {{ Form::checkbox($notification->id, 1, false) }} {{ $notification->term }}
                    </p>
                @endforeach

                <hr/>

                {{ Form::submit('Delete', ['class' => 'btn btn-primary btn-sm']) }}

                {{ link_to_action('ProfilesController@index', 'Cancel', null, ['class' => 'btn btn-sm btn-default cancel_button']) }}

            {{ Form::close() }}
        </div>

    </div>

</div>
@stop

@section('_title')
    Edit {{ $user->first_name }} {{ $user->last_name }}'s Notification Settings - EriePaJobs
@stop