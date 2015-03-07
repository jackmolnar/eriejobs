{{ Form::open(['action' => 'SearchController@index']) }}

{{ Form::label('search', 'Enter Job Titles, Company Names, or Keyterms') }}

<br/>

{{ Form::text('search_term', $term, ['class' => 'form-control search_box', 'placeholder' => 'Search Term']) }}

<button class="btn btn-primary search_button" type="submit" ><i class="fa fa-search"></i> Search</button>

{{ Form::close() }}

@if($term != '')
    @if(Auth::check())
        <hr/>
        @include('includes.notifications.add_search_term')
    @endif
@endif