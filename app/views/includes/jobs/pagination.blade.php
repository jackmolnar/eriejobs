@if(isset($results))
    <div class="pagination_links">
        @if($term != '' )
            {{ $results->appends(array('search_term' => $term))->links() }}
        @else
            {{ $results->links() }}
        @endif
    </div>
@endif
