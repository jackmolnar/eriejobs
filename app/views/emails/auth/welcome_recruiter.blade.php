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
<p>
Now for a limited time, to celebrate our launch and to prove our value to you, <b>job listings on EriePaJobs are absolutely free, no strings attached.</b>
Even after our free trial period, we're committed to providing our services at competitive rates, in fact below other employment websites such as Indeed and Monster!
</p>
<hr/>
<p>In addition at EriePaJobs:</p>
<ul>
    <li style="margin-bottom: 15px">We advertise heavily in the Erie region, so you can be sure that we are trying our very best to get eyeballs on your listing</li>
    <li style="margin-bottom: 15px">All new listings are posted and shared on our <a href="https://www.facebook.com/eriepajobs">Facebook</a>, <a href="https://twitter.com/EriePaJobsCom">Twitter</a>, and <a href="https://www.linkedin.com/company/eriepajobs-com">LinkedIn</a> accounts, further driving traffic to your listing</li>
    <li style="margin-bottom: 15px">Listings are included in our weekly notification emails and are text messaged to users immediately after posting, so users looking for employment opportunities related to your listing will be notified of your opportunity directly</li>
</ul>
<hr/>
<p>
Our goal is to continually improve the website, so if you have feedback or suggestions on how we can improve, please <a href="https://eriepajobs.com/contact">drop us a line.</a>
</p>
<h3>Now go and <a href="https://eriepajobs.com/jobs/create">list your job opportunities!</a> </h3>

@stop
