@if(count($user->jobs) > 0)
<div class="well">

    <h3>My Active Listings</h3>

    <table class="table">
    <tr>
        <th>Job Listing</th>
        <th>Expires</th>
        <th>Active</th>
        <th>Edit</th>
    </tr>
        @foreach($user->jobs as $job)
            <tr>
                <td>{{ link_to_action('JobsController@show', $job->title, $job->id, ['class' => 'title-'.$job->id]) }}</td>
                <td>{{ $job->expire->diffForHumans() }}</td>
                <td>
                    @if($job->active)
                        {{ link_to('#', 'Active', ['class' => 'btn btn-primary btn-xs activate_button active', 'data-jobid' => $job->id, 'data-active' => 1]) }}
                    @else
                        {{ link_to('#', 'Inactive', ['class' => 'btn btn-primary btn-xs activate_button', 'data-jobid' => $job->id, 'data-active' => 0]) }}
                    @endif
                </td>
                <td>
                    <div class="btn-group btn-group-xs" role="group" >
                        {{ link_to_action('JobsController@edit', 'Edit', $job->id, ['class' => 'btn btn-warning btn-xs']) }}
                        {{--{{ link_to_action('JobsController@destroy_confirm', 'Delete', $job->id, ['class' => 'btn btn-danger btn-xs', 'data-toggle' => 'modal', 'data-target' => '#deleteModal']) }}--}}
                        <button class="btn btn-danger btn-xs delete_button" data-toggle="modal" data-target="#deleteModal" data-jobid="{{ $job->id }}">Delete</button>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</div>


@include('includes/modals/delete_modal');
@endif

