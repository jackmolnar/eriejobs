<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>@yield('_title')</title>
<meta name="description" content="@yield('_description')" />

<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Titillium+Web:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="/css/main_styles.css" />
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


</body>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}" ></script>
<script src="{{ asset('/js/dropzone.js') }}"></script>
<script src="{{ asset('/js/main_scripts.js') }}"></script>
@yield('scripts')

</html>