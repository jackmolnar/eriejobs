@extends('...layouts.default')

@section('content')

    <div class="profile">

        <h1>Edit Notification Settings</h1>

        <div class="col-md-9 ">
            <div class="well edit_info">

                <p>Select how you want to receive notifications about jobs related to your notification terms. Remember, you'll only receive notifications related to the terms you choose. You can choose to no longer receive notifications at any time.</p>

                <hr/>

                {{ Form::open(['action' => ['ProfilesController@update_notification_settings', $user->id], 'method' => 'put']) }}

                <div class="checkbox">
                    <label>
                        {{ Form::checkbox('email_notifications', 1, $user->email_notifications) }} Receive weekly email notifications about the latest listings.
                    </label>
                </div>

                <div class="checkbox">
                    <label>
                        {{ Form::checkbox('sms_notifications', 1, $user->sms_notifications, ['id' => 'sms_checkbox']) }} Receive immediate SMS text message notifications about jobs as they are listed.
                    </label>
                </div>

                @if($user->phone_number != '')
                    <hr/>
                    <p>Verified Mobile Phone Number: <span id="user_verified_phone_number">{{ $user->phone_number }}</span></p>
                    <div class="btn btn-default btn-xs " id="edit_phone_number_button">Edit Phone Number</div>
                    {{ link_to_action('NotificationsController@delete_phone_number', 'Delete Phone Number', $user->id, ['class' => 'btn btn-default btn-xs']) }}
                @endif

                <hr/>

                {{ Form::submit('Save', ['class' => 'btn btn-primary btn-sm']) }}

                {{ link_to_action('ProfilesController@index', 'Cancel', null, ['class' => 'btn btn-sm btn-default cancel_button']) }}

                {{ Form::close() }}
            </div>
        </div>
    </div>

    @include('includes/modals/verify_phone_modal')
@stop

@section('_title')
    Edit {{ $user->first_name }} {{ $user->last_name }}'s Notification Settings - EriePa.Jobs
@stop