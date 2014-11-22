@extends('layouts.default')

@section('content')

<div class="search">

<div class="well">

    <h1>Results for {{ $term }}</h1>

    <hr/>

    @foreach($results as $result)
        <div>
            {{ $result->title }}
        </div>
    @endforeach

</div>


</div>

@stop