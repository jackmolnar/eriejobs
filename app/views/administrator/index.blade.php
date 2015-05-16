@extends('layouts.default')

@section('content')

    <div class="profile">

        <h1>Administration</h1>

        @include('includes.administrator.nav')

        <div class="well col-md-12">

            <h3>Jobs</h3>

            <table id="jobs" class="table table-hover table-condensed">
                <thead>
                <tr>
                    <th class="col-md-3">Id</th>
                    <th class="col-md-3">Title</th>
                    <th class="col-md-3">Company</th>
                    <th class="col-md-3">Created</th>
                    <th class="col-md-3">Expire</th>
                    <th class="col-md-3">Applications</th>
                </tr>
                </thead>
            </table>

            {{--<ul>--}}
            {{--@foreach($jobs as $job)--}}
                {{--<li>{{ link_to_action('JobsController@show', $job->title, [$job->slug]) }} {{ count($job->applications) }}</li>--}}
            {{--@endforeach--}}
            {{--</ul>--}}
            {{--{{ link_to_action('BlogController@create', 'Create Post', null, ['class' => 'btn btn-primary btn-sm']) }}--}}

        </div>

    </div>

@stop

@section('scripts')
    <script src="//datatables.net/download/build/nightly/jquery.dataTables.min.js?_=bacd2f3ab91ef964590836364bbce38e"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            oTable = $('#jobs').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "/api/job-data",
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'company_name', name: 'company_name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'expire', name: 'expire'},
                    {data: 'Applications', name: 'Applications'},
                ]
            });
        });
    </script>
@stop

@section('_title')
    {{ $user->first_name }} {{ $user->last_name }}'s Profile - EriePaJobs
@stop