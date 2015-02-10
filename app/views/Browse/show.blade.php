@extends('layouts.default')

@section('content')

<div class="browse">

    <div class="col-md-9">

        <div class="well">
            @if(Auth::check())
                @include('includes.notifications.add_search_term')
            @endif
        </div>

    <h1>Browse {{ $category['category']->category }} Jobs</h1>

    <hr/>

        @if(count($category['jobs']))
            @foreach($category['jobs'] as $result)
                @include('includes.jobs.listing')
            @endforeach
        @else
            <h2>We're sorry, there are no jobs currently posted in {{$category['category']->category}} category.</h2>
        @endif

    </div>


</div>

@stop

@section('_title')
Browse {{ $category['category']->category }} Jobs in Erie Pa
@stop

@section('_description')
Browse available {{ $category['category']->category }} jobs in Erie Pennsylvania and Northwestern Pennsylvania.
@stop