@if(isset($results))
    <div class="row">
        @if($term != '' )
            {{ $results->appends(array('search_term' => $term))->links() }}
        @else
            {{ $results->links() }}
        @endif
    </div>
@endif
