@extends('layouts.email_template')

@section('content')

<h2>
@if(isset($first_name))
    {{ $first_name }},
@endif
Welcome to EriePa.Jobs!</h2>
<hr/>
<p>
EriePa.Jobs is committed to helping you find your next employment opportunity. It is our mission to match great talent like you with Northwestern Pennsylvania's best employers.
</p>
<hr/>
<p>
Some things you may want to do to get the most out of the website are:
<ul>
    <li style="margin-bottom: 15px">Add email notifications for custom job searches - simply perform your <a href="{{secure_url('search')}}">search</a> and add that term to your notification list</li>
    <li style="margin-bottom: 15px">Follow us on <a href="https://www.facebook.com/eriepajobs">Facebook</a>, <a href="https://twitter.com/EriePaJobsCom">Twitter</a>, and <a href="https://www.linkedin.com/company/eriepajobs-com">LinkedIn</a> - we post new listings on all our social accounts</li>
    <li style="margin-bottom: 15px"><a href="{{ secure_url('browse') }}">Browse</a> new job listings by category - we organize job listings by many categories to help you find opportunities that match industries you're interested in</li>
</ul>
</p>
<hr/>
<p>
Now, go <a href="{{ secure_url('login') }}">login</a> and find your next employment opportunity!
</p>



@stop
