@extends('layouts.default')

@section('content')

<div class="browse">

    <div class="col-md-9">

    <h1>{{ $category['category']->category }} Jobs</h1>

    <hr/>

        @foreach($category['jobs'] as $result)
            @include('includes.jobs.listing')
        @endforeach

    </div>


</div>

@stop
