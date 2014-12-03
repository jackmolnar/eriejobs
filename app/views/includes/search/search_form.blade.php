<div class="well">

    <h1>Search For Jobs</h1>

    <hr/>

    {{ Form::open(['action' => 'SearchController@index']) }}

    {{ Form::label('search', 'Enter Job Titles, Company Names, or Keyterms') }}

    <br/>

    {{ Form::text('search_term', null, ['class' => 'form-control search_box', 'placeholder' => 'Search Term']) }}

    {{ Form::submit('Search', ['class' => 'btn btn-primary search_button']) }}

    {{ Form::close() }}

</div>
