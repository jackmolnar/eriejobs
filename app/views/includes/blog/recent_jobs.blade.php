@if(count($recentJobs))
    <div class="recent_jobs well">
        <h3>Recent Job Postings on EriePaJobs</h3>
        <hr>
        <ul>
            @foreach($recentJobs as $recentJob)
                <li><h4>{{ link_to_action('JobsController@show', $recentJob->title, $recentJob->slug) }}</h4></li>
            @endforeach
        </ul>
        <hr>
        {{ link_to_action('SearchController@index', 'View All Postings >') }}
        <hr>
        @if(!$user)
            {{ link_to_action('AuthController@getSeekerSignup', 'Signup to Apply for these Openings', null, ['class' => 'btn btn-xs btn-primary']) }}
        @endif
    </div>
@endif
