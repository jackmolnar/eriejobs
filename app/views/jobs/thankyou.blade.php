@extends('layouts.default')

@section('content')

<div class="jobs">

    <div class="col-md-9">
        <h1 style="display: block">Your Job Has Been Listed!</h1>

        <hr/>

        <p>
            Congratulations on posting your new job listing! Soon applicants will be contacting you.
        </p>
        <p>
            Remember, you can access your listing from your {{ link_to_action('ProfilesController@index', 'profile dashboard') }} in case you need to edit your listing, activate or reactivate your listing, or completely delete your listing.
        </p>

        <hr/>

        {{ link_to_action('ProfilesController@index', 'Return To Your Dashboard', null, ['class' => 'btn btn-primary']) }}

    </div>

</div>

@stop

@section('_title')
    Thank You For Listing Your Job on EriePaJobs
@stop
