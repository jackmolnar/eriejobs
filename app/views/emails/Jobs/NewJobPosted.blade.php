@extends('layouts.email_template')

@section('content')

<h2>Your Job Listing Has Been Posted</h2>
<hr/>
<p>
Thank you for posting your listing on EriePa.Jobs! We're committed to helping you achieve your recruitment goals and are pleased you chose us to assist you.
</p>
<hr/>
<p>
Your new job listing for
</p>
<p>
    <h4>
        @if(isset($job))
            {{ $job['title'] }}
        @else
            TEST JOB
        @endif
    </h4>
</p>
<p>
has been posted.
</p>
<hr/>
<p>
You can visit your {{ link_to_action('ProfilesController@index', 'profile dashboard', null, ['target' => '_blank']) }} to update the listing, deactivate the listing, and delete the listing.
</p>
@stop
