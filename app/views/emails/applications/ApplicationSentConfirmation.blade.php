@extends('layouts.email_template')

@section('content')

<h2>
@if(isset($first_name))
    {{ $first_name }},
@endif
Your Application Has Been Sent!</h2>
<hr/>
<p>
Congratulations on applying for yor new employment opportunity!</p>
<hr/>
<p>
Your application for:
</p>
<p>
<h4>
@if(isset($job_title))
    {{ $job_title }}
@else
    TEST JOB
@endif
</h4>
<p>
has been submitted.
</p>
<hr/>
<p>
We wish you the best of luck!
</p>


@stop
