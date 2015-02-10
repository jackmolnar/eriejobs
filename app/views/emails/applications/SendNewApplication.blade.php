@extends('layouts.email_template')

@section('content')

<h2>
You Have Received a New Application For the {{ $job['title'] }} Position
</h2>
<hr/>
<p>
    The resume for this application is attached to this email. Below you'll find the applicants cover letter and introduction.
</p>
<hr/>
<p>
    {{ $cover_letter }}
</p>
<hr/>
@stop
