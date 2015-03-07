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

        <hr/>

        <div class="row">
            <button class="btn btn-default btn-xs delete_account_button" data-toggle="modal" data-target="#deleteAccountModal">Delete Account</button>
        </div>

    </div>

    <div class="well">
        <h3 class="info_header"><i class="fa fa-cloud-upload"></i> Resume</h3>
        <p>Upload a resume you can use to apply for jobs. This is mainly used for applying quickly and from mobile devices. You can upload
            other resumes at the time of application if you choose.</p>

        <div class="upload_button">
            <button class="btn btn-primary"><i class="fa fa-plus-circle"></i>
                @if($user->filename)
                    Replace resume ...
                @else
                    Choose a Resume ...
                @endif
            </button>
            {{--<input type="file" />--}}
        </div>

        @include('includes/main/upload')

        @if($user->filename)
            <hr/>
            <h3><i class="fa fa-paperclip"></i> Current Resume</h3>
            {{ $user->filename }}
            <button class="btn btn-default btn-xs delete_account_button" data-toggle="modal" data-target="#deleteResumeModal">Delete Resume</button>
        @endif

    </div>

    <div class="well">

        <h3 class="notification_header"><i class="fa fa-envelope"></i> Email Notifications</h3>

        @if(count($user->jobNotifications))

            {{ link_to_action('ProfilesController@edit_notifications', 'Edit Notifications', null, ['class' => 'btn btn-default btn-xs edit_button']) }}

            <div class="row">
                <ul>
                    @foreach($user->jobNotifications as $notification)
                        <li>{{ $notification->term }}</li>
                    @endforeach
                </ul>
            </div>
        @else
            <p>You haven't yet signed up to receive notification emails for search terms.</p>
            <p>Visit the {{ link_to_action('SearchController@index', 'Search Page') }} page to sign up for them!</p>
        @endif

    </div>

</div>

@include('includes/modals/delete_account_modal')
@include('includes/modals/delete_resume_modal')
