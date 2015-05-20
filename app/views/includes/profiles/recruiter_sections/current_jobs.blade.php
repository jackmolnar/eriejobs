@if(count($user->jobs) > 0)
    <h3><i class="fa fa-pencil"></i> My Active Job Listings</h3>

    <table class="table">
        <tr>
            <th>Job Listing</th>
            <th>Expires</th>
            {{--<th>Applications</th>--}}
            <th></th>
            <th></th>
        </tr>
        @foreach($user->jobs as $job)
            <tr>
                <td>{{ link_to_action('JobsController@show', $job->title, $job->slug, ['class' => 'title-'.$job->id]) }}</td>
                <td>{{ $job->expire->diffForHumans() }}</td>
                {{--<td>{{ count($job->applications()->get()) }}</td>--}}
                <td>
                    @if($job->active)
                        {{ link_to('#', 'Active', ['class' => 'btn btn-primary btn-xs activate_button active', 'data-jobid' => $job->id, 'data-active' => 1]) }}
                    @else
                        {{ link_to('#', 'Inactive', ['class' => 'btn btn-primary btn-xs activate_button', 'data-jobid' => $job->id, 'data-active' => 0]) }}
                    @endif
                </td>
                <td>
                    <div class="btn-group btn-group-xs" role="group" style="float: right"  >
                        {{ link_to_action('JobsController@edit', 'Edit', $job->slug, ['class' => 'btn btn-warning btn-xs']) }}
                        {{--{{ link_to_action('JobsController@destroy_confirm', 'Delete', $job->id, ['class' => 'btn btn-danger btn-xs', 'data-toggle' => 'modal', 'data-target' => '#deleteModal']) }}--}}
                        <button class="btn btn-danger btn-xs delete_button" data-toggle="modal" data-target="#deleteModal" data-jobid="{{ $job->id }}">Delete</button>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
@else
    <h3><i class="fa fa-pencil"></i> My Active Job Listings</h3>
    <hr/>
    <p>You don't currently have any active job listings.</p>
    <p>{{ link_to_action('JobsController@create', 'Post One Now!', null, ['class' => 'btn btn-primary']) }}</p>
@endif
