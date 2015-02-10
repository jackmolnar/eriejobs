<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">

<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Titillium+Web:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="/css/main_styles.css" />
</head>
<body style="background-color: #2A2C2B; padding-top: 50px; width:700px; min-height: 400px; margin-left: auto; margin-right: auto;">

@include('../includes.email.email_header')
<div class="container" style="background-color: #fff; width:700px; border-radius: 15px; padding: 35px;">
    @yield('content')
</div>

@include('../includes.email.email_footer')


</body>

</html>