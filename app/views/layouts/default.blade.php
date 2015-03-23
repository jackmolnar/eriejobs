<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>@yield('_title')</title>
<meta name="description" content="@yield('_description')" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1.0">
<meta name="robots" content="index, follow">

<link rel="shortcut icon" href="https://eriepajobs.com/favicon.png">

<meta property="og:url"         content="{{ Request::url() }}" />
<meta property="fb:app_id"      content="281126498752497" />
<meta property="og:type"        content="website" />
<meta property="og:title"       content="@yield('_title')" />
<meta property="og:description" content="@yield('_description')" />
<meta property="og:image"       content="{{ url('images/og_image.png') }}" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />

<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Titillium+Web:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="/css/main_styles.css" />

    {{-- FB Remarketing Pixel --}}
    <script>(function() {
            var _fbq = window._fbq || (window._fbq = []);
            if (!_fbq.loaded) {
                var fbds = document.createElement('script');
                fbds.async = true;
                fbds.src = '//connect.facebook.net/en_US/fbds.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(fbds, s);
                _fbq.loaded = true;
            }
            _fbq.push(['addPixelId', '803393913072061']);
        })();
        window._fbq = window._fbq || [];
        window._fbq.push(['track', 'PixelInitialized', {}]);
    </script>
    <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=803393913072061&amp;ev=PixelInitialized" /></noscript>

</head>
<body>

@include('../includes.ga_tracking.ga_tracking')

@include('../includes.main.top_nav')

<div class="main_row">
    @yield('main_row')
</div>


<div class="container">
    @include('../includes.main.errors')
    @include('../includes.main.success')
    @yield('content')
</div>

@include('../includes.main.footer')

{{-- Google Remarketing --}}
<script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 1033082546;
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
    /* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
    <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1033082546/?value=0&amp;guid=ON&amp;script=0"/>
    </div>
</noscript>



</body>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}" ></script>
<script src="{{ asset('/js/dropzone.js') }}"></script>
<script src="{{ asset('/js/main_scripts.js') }}"></script>
@yield('scripts')

</html>