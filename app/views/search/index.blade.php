@extends('layouts.default')

@section('content')

<div class="search">

<div class="well">

    <h1>Search For Jobs</h1>

    <hr/>

    {{ Form::open(['action' => 'SearchController@result']) }}

    {{ Form::label('search', 'Enter Job Titles, Company Names, or Keyterms') }}

    {{ Form::text('search_term', null, ['class' => 'form-control', 'placeholder' => 'Search Term']) }}

    {{ Form::close() }}

</div>


</div>

@stop