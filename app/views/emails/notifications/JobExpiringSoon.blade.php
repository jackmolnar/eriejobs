@extends('layouts.email_template')

@section('content')
    <h2>
        @if(isset($first_name))
            {{ $first_name }},
        @endif
        your job listing for {{ $expiringJob->title }} is expiring soon.</h2>
    <hr/>
    <p>
        Hi @if(isset($first_name)) {{ $first_name }}, @else TEST USER, @endif your job listing for {{ link_to_action('JobsController@show', $expiringJob->title, [$expiringJob->slug, 'utm_source' => 'Email', 'utm_medium' => 'Internal Email', 'utm_campaign' => 'Job Expiring']) }} is expiring soon. This is just a notification to make you aware that when your listing expires, it will no longer be active on EriePaJobs.com.
    </p>
    <p>
        If you are still hiring for this position, you can easily repost it with just a couple of clicks after it expires by {{ link_to_action('AuthController@getLogin', 'logging in', ['utm_source' => 'Email', 'utm_medium' => 'Internal Email', 'utm_campaign' => 'Job Expiring']) }} to your account, and clicking "Repost" next the the listing under "Recently Expired Jobs."
    </p>
    <p>
        We hope that you continue to list job openings on EriePaJobs.com in the future. If you have feedback about your experience, we would love to hear it! {{ link_to_action('PagesController@getContact', 'Contact us here!', ['utm_source' => 'Email', 'utm_medium' => 'Internal Email', 'utm_campaign' => 'Job Expiring']) }}
    </p>
@stop