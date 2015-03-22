<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>@yield('_title')</title>
<meta name="description" content="@yield('_description')" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1.0">
<link rel="shortcut icon" href="https://eriepajobs.com/favicon.png">
<meta name="robots" content="index, follow">

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
<link rel="stylesheet" href="/css/main_styles.css" />
</head>
<body>

@include('../includes.ga_tracking.ga_tracking')

@include('../includes.main.top_nav')

    @yield('content')

@include('../includes.main.footer')

</body>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}" ></script>
<script src="{{ asset('/js/main_scripts.js') }}"></script>
</html>