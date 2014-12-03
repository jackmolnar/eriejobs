<div class="col-md-9">

    <div class="well">

        <h3 class="info_header">My Info</h3>

        {{ link_to_action('ProfilesController@edit_info', 'Edit', null, ['class' => 'btn btn-warning btn-xs edit_button']) }}

        <div class="row">

        <div class="col-md-6">
            <b>First Name:</b> {{ $user->first_name }}<br/>
            <b>Email:</b> {{ $user->email }}<br/>
        </div>
        <div class="col-md-6">
            <b>Last Name:</b> {{ $user->last_name }}<br/>
        </div>

        </div><!-- end row -->

        <hr/>

        <h3>Notification Settings</h3>

        <div>
        </div>

    </div>

</div>