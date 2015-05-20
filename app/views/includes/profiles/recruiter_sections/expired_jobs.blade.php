@if(count($user->jobs()->onlyTrashed()->get()))
    <hr/>
    <h3 style="margin-top: 40px"><i class="fa fa-pencil"></i> Recently Expired / Deleted Job Listings</h3>

    <table class="table">
        <tr>
            <th>Job Listing</th>
            <th>Deleted / Expired</th>
            <th></th>
            <th></th>
        </tr>
        @foreach($user->jobs()->onlyTrashed()->orderBy('deleted_at', 'desc')->take(10)->get() as $job)
            <tr>
                <td>{{ link_to_action('JobsController@showTrashed', $job->title, $job->slug, ['class' => 'title-'.$job->id]) }}</td>
                <td>{{ $job->deleted_at->diffForHumans() }}</td>
                <td>
                </td>
                <td>
                    <div class="btn-group btn-group-xs" role="group" style="float: right"  >
                        {{ link_to_action('JobsController@repost', 'Repost Job', $job->slug, ['class' => 'btn btn-success btn-xs']) }}
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
@endif