<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">

</head>
<body style="background-color: #2A2C2B; padding-top: 50px; width:700px; min-height: 400px; margin-left: auto; margin-right: auto;">

@include('../includes.email.email_header')
<div class="container" style="background-color: #fff; width:700px; border-radius: 15px; padding: 35px;">
    @yield('content')
</div>

@include('../includes.email.email_footer')


</body>

</html>