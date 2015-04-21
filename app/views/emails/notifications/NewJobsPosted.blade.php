@extends('layouts.email_template')

@section('content')

<h2>
@if(isset($first_name))
    {{ $first_name }},
@endif
New Jobs Have Been Posted!</h2>
<hr/>
<p>
Hi @if(isset($first_name)) {{ $first_name }}, @else TEST USER, @endif new jobs have been posted to EriePaJobs that match your notification settings. Click the listings below to see more details and apply.
</p>
<hr/>
@foreach($jobData as $result)

    <ul>
        <li><a href="{{ secure_url('jobs') }}{{ '/'.$result['slug'] }}">{{ $result['title'] }}</a> </li>
    </ul>
    <hr/>

@endforeach

    <p style="font-size: 12px">
        You are receiving this email because you opted to get notifications of new job listings based on your prefrences. You can <a href="{{ secure_url('edit-notification-settings') }}">unsubscribe here.</a>
    </p>

@stop