@extends('layouts.default')

@section('content')

<div class="browse">

<div class="well">

    <h1>Choose a Category to Browse</h1>

    <hr/>

    <ul class="categoryList">
        @foreach($categories as $category)
            <li>
                {{ link_to_action('BrowseController@show', $category['category'], [$category['slug']] ) }}
                @if($category['job_count'] > 0)
                    <span class="badge">{{ $category['job_count'] }}</span>
                @endif
            </li>
        @endforeach
    </ul>

</div>


</div>

@stop

@section('_title')
Browse Jobs in Erie and Northwestern Pennsylvania - EriePaJobs
@stop

@section('_description')
Browse available jobs in Erie Pennsylvania and Northwestern Pennsylvania at EriePaJobs.com.
@stop