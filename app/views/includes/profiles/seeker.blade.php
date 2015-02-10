<div class="col-md-9">

    <div class="well">

        <h3 class="info_header"><i class="fa fa-user"></i> General Information</h3>

        {{ link_to_action('ProfilesController@edit_info', 'Edit Profile', null, ['class' => 'btn btn-default btn-xs edit_button']) }}

        <div class="row">

            <div class="col-md-6">
                <b>First Name:</b> {{ $user->first_name }}<br/>
                <b>Email:</b> {{ $user->email }}<br/>
            </div>
            <div class="col-md-6">
                <b>Last Name:</b> {{ $user->last_name }}<br/>
            </div>

        </div><!-- end row -->


        @if(count($user->jobNotifications))

        <hr/>

        <h3 class="notification_header"><i class="fa fa-envelope"></i> Email Notifications</h3>
        {{ link_to_action('ProfilesController@edit_notifications', 'Edit Notifications', null, ['class' => 'btn btn-default btn-xs edit_button']) }}

        <div class="row">
            <ul>
                @foreach($user->jobNotifications as $notification)
                    <li>{{ $notification->term }}</li>
                @endforeach
            </ul>
        </div>

        @endif

        <hr/>

        <div class="row">
            <button class="btn btn-default btn-xs delete_account_button" data-toggle="modal" data-target="#deleteAccountModal">Delete Account</button>
        </div>

    </div>

</div>

@include('includes/modals/delete_account_modal')
