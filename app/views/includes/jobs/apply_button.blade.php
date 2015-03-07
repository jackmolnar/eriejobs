@if($job->email != '')
    {{ link_to_action('ApplicationsController@create', 'Apply', [$job->id], ['class' => 'btn btn-primary']) }}
@elseif($job->link != '')
    {{ link_to($job->link, 'Apply', ['class' => 'btn btn-primary']) }}
@endif
