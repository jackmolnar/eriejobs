<div class="row job_listing">
    <div class="col-md-8">
        <h4>{{ link_to_action('JobsController@show', $result->title, ['job_id' => $result->slug] ) }}</h4>
        @if( $result->confidential == 1)
            <span class="company_name">Confidential</span>
        @else
            <span class="company_name">{{ $result->company_name }}</span>
        @endif
    </div>
    <div class="col-md-3">
        <span class="company_city"><i class="fa fa-map-marker"></i>{{ $result->company_city }}</span>
        <span class="posted_date"><i class="fa fa-calendar"></i> Posted {{ $result->created_at->diffForHumans() }}</span>
    </div>
    <div class="col-md-1">
        @if(isset($user))
            @if($result->created_at > $user->last_login->subDays(7))
                <span class="new_tag">NEW</span>
            @endif
        @endif
    </div>
</div>
<hr/>