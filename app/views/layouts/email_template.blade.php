<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">

</head>
<body>

@include('../includes.email.email_header')
<div class="container" style="background-color: #fff; width:700px; border-radius: 15px; padding: 35px;">
    @yield('content')
</div>

@include('../includes.email.email_footer')


</body>

</html>