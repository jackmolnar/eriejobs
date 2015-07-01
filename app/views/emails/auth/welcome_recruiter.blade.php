@extends('layouts.email_template')

@section('content')

<h2>
@if(isset($first_name))
    {{ $first_name }},
@endif
Welcome to EriePaJobs!</h2>
<hr/>
<p>
EriePaJobs is committed to helping you tap into the talent pool in Northwestern Pennsylvania. Our website is the only website that exclusively focuses on the job market in the Erie region. EriePaJobs is locally owned, so we have a vested interest in your success and in the community.
</p>
<hr/>
<p>In addition at EriePaJobs:</p>
<ul>
    <li style="margin-bottom: 15px">Help wanted ads are affordable. They start at just $119 - 40% lower than Monster or LinkedIn</li>
    <li style="margin-bottom: 15px">We advertise heavily in the Erie region, so you can be sure that we are trying our very best to get eyeballs on your listing</li>
    <li style="margin-bottom: 15px">Job listings are posted and promoted on national employment website Indeed. This gets your listing more exposure and gets you more applicants</li>
    <li style="margin-bottom: 15px">All new listings are posted and shared on our <a href="https://www.facebook.com/eriepajobs">Facebook</a>, <a href="https://twitter.com/EriePaJobsCom">Twitter</a>, and <a href="https://www.linkedin.com/company/eriepajobs-com">LinkedIn</a> accounts, further driving traffic to your listing</li>
    <li style="margin-bottom: 15px">Listings are included in our weekly notification emails and are text messaged to users immediately after posting, so users looking for employment opportunities related to your listing will be notified of your opportunity directly</li>
</ul>
<hr/>
<p>
Our goal is to continually improve the website, so if you have feedback or suggestions on how we can improve, please {{ link_to_action('PagesController@getContact', 'drop us a line.', ['utm_source' => 'Email', 'utm_medium' => 'Internal Email', 'utm_campaign' => 'Recruiter Signup']) }}
</p>
<h3>Now go and {{ link_to_action('JobsController@create', 'list your available job opportunities!', ['utm_source' => 'Email', 'utm_medium' => 'Internal Email', 'utm_campaign' => 'Recruiter Signup']) }}</h3>

@stop
