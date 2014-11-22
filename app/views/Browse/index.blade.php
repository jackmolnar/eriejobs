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
                    ({{ $category['job_count'] }})
                @endif
            </li>
        @endforeach
    </ul>

</div>


</div>

@stop
