<div class="row job_listing">
    <div class="col-md-8">
        <h4>{{ link_to_action('JobsController@show', $result->title, ['job_id' => $result->id] ) }}</h4>
        <span class="company_name">{{ $result->company_name }}</span>
    </div>
    <div class="col-md-3">
        <span class="company_city">{{ $result->company_city }}</span>
        <span class="posted_date">Posted {{ $result->created_at->diffForHumans() }}</span>
    </div>
    <div class="col-md-1">
        @if($result->created_at < $user->last_login)
            <span class="new_tag">NEW</span>
        @endif
    </div>
</div>
<hr/>