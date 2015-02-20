@extends('layouts.email_template')

@section('content')

<h2>
@if(isset($first_name))
    {{ $first_name }},
@endif
New Jobs Have Been Posted!</h2>
<hr/>
<p>
Hi @if(isset($first_name)) {{ $first_name }}, @else TEST USER, @endif new jobs have been posted to EriePa.Jobs that match your notification settings. Click the listings below to see more details and apply.
</p>
<hr/>
@foreach($jobData as $searchTerm => $results)

    <h4>New Jobs for "{{ $searchTerm }}"</h4>

    <ul>
    @foreach($results as $job)
        <li>{{ link_to_action('JobsController@show', $job['title'], $job['id']) }}</li>
    @endforeach
    </ul>
    <hr/>

@endforeach


@stop