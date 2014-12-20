<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Document</title>

<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Titillium+Web:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="/css/main_styles.css" />
</head>
<body>


@include('../includes.main.top_nav')


<div class="container">
    @include('../includes.main.errors')
    @include('../includes.main.success')
    @yield('content')
</div>

@include('../includes.main.footer')


</body>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="http://eriepa.jobs:8000/js/main_scripts.js"></script>
<script src="http://eriepa.jobs:8000/js/modal.min.js"></script>

@yield('scripts')

</html>