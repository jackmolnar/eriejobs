<div class="well col-md-10">

    @if(count($user->jobs) > 0)
        <h3><i class="fa fa-pencil"></i> My Active Job Listings</h3>

        <table class="table">
            <tr>
                <th>Job Listing</th>
                <th>Expires</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($user->jobs as $job)
                <tr>
                    <td>{{ link_to_action('JobsController@show', $job->title, $job->slug, ['class' => 'title-'.$job->id]) }}</td>
                    <td>{{ $job->expire->diffForHumans() }}</td>
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
</div>




<div class="well col-md-10">

    <h3 class="info_header"><i class="fa fa-user"></i> General Information</h3>

    {{ link_to_action('ProfilesController@edit_info', 'Edit Profile', null, ['class' => 'btn btn-default btn-xs edit_button']) }}

    <div class="row">
        <div class="col-md-6">
            <b>First Name:</b> {{ $user->first_name }}<br/>
            <b>Email:</b> {{ $user->email }}<br/>
        </div>
        <div class="col-md-6">
            <b>Last Name:</b> {{ $user->last_name }}<br/>
        </div>
    </div><!-- end row -->

    <hr/>

    <div class="row">
        <button class="btn btn-default btn-xs delete_account_button" data-toggle="modal" data-target="#deleteAccountModal">Delete Account</button>
    </div>

</div>

@if(count($user->jobs) > 0)
    @include('includes/modals/delete_modal')
@endif

@include('includes/modals/delete_account_modal')


