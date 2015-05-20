@if($job->email != '')
    {{ link_to_action('ApplicationsController@create', 'Apply', [$job->slug], ['class' => 'btn btn-primary']) }}
@elseif($job->link != '')
    {{ link_to($job->link, 'Apply', ['class' => 'btn btn-primary', 'id' => 'apply_click', 'data-job' => $job->slug]) }}
@endif
