@extends('layouts.default')

@section('content')

    <div class="jobs col-md-9">
        <h1>Your Application for {{ $job->title }} Has Been Sent!</h1>

        <hr/>

        @if($job->confidential)
            <p>
                You should hear back from {{ $job->company_name }} soon! In the meantime {{ link_to_action('SearchController@index', 'check out') }} other career opportunities and apply for other positions.
            </p>
        @else
            <p>
                You should hear back soon! In the meantime {{ link_to_action('SearchController@index', 'check out') }} other career opportunities and apply for other positions.
            </p>
        @endif
    </div>

@stop

@section('_title')
    Application for {{ $job->title }} Sent - EriePaJobs
@stop

@section('scripts')
    <!-- Begin INDEED conversion code -->

    <script type="text/javascript">
        /* <![CDATA[ */

        var indeed_conversion_id = '9061630478569686';
        var indeed_conversion_label = '';

        /* ]]> */
    </script>

    <script type="text/javascript" src="//conv.indeed.com/pagead/conversion.js"></script>
    <noscript>
        <img height=1 width=1 border=0 src="//conv.indeed.com/pagead/conv/9061630478569686/?script=0">
    </noscript>

    <!-- End INDEED conversion code -->
@stop