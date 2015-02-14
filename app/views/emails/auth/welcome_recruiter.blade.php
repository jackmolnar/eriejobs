@extends('layouts.email_template')

@section('content')

<h2>
@if(isset($first_name))
    {{ $first_name }},
@endif
Welcome to EriePa.Jobs!</h2>
<hr/>
<p>
EriePa.Jobs is committed to helping you tap into the talent pool in Northwestern Pennsylvania. Our website is the only website that exclusively focuses on the job market in the Erie region. EriePa.Jobs is locally owned, so we have a vested interest in your success and in the community.
</p>
<p>
Now for a limited time, to celebrate our launch and to prove our value to you, <b>job listings on EriePa.Jobs are absolutely free, no strings attached.</b>
Even after our free trial period, we're committed to providing our services at competitive rates, in fact below other employment websites such as Indeed and Monster!
</p>
<hr/>
<p>In addition at EriePa.Jobs:</p>
<ul>
    <li style="margin-bottom: 15px">We advertise heavily in the Erie region, so you can be sure that we are trying our very best to get eyeballs on your listing</li>
    <li style="margin-bottom: 15px">All new listings are posted and shared on our social network accounts, further driving traffic to your listing</li>
    <li style="margin-bottom: 15px">Listings are included in our weekly notification emails, so users looking for employment opportunities related to your listing will be notified of your opportunity directly</li>
</ul>
<hr/>
<p>
Our goal is to continually improve the website, so if you have feedback or suggestions on how we can improve, please drop us a line.
</p>
<h3>Now go and list your job opportunities!</h3>

@stop
