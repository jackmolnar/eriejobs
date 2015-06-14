@extends('layouts.default')


@section('content')
    <div class="login">
        <div class="col-lg-6 well">
            <h1>Restore Your Account</h1>
            <hr/>
            <p>
                {{ $result }}
            </p>
            <hr/>
        </div>

        <div class="col-md-4 col-md-offset-2">
            @if(Agent::isMobile())
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- mobile banner -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:320px;height:100px"
                     data-ad-client="ca-pub-5103028415668122"
                     data-ad-slot="3467674298"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            @else
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- Test Ads -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:300px;height:600px"
                     data-ad-client="ca-pub-5103028415668122"
                     data-ad-slot="7829958692"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            @endif
        </div>

    </div>
@stop

@section('_title')
    EriePaJobs - Restore User Account
@stop
@section('_description')
    Restore your user account on EriePaJobs.
@stop
