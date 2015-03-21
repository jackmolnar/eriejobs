<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">

</head>

<body bgcolor="#353e38">
<table width="100%" bgcolor="#353e38" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <table width="580" align="center" cellpadding="5" cellspacing="0" border="0" style="font-family: sans-serif; font-size: 14px; line-height: 24px">
                <tr>
                    <td>
                        @include('../includes.email.email_header')
                    </td>
                </tr>
                <tr>
                    <td bgcolor="white" style="padding: 15px; border-top: orangered thick solid; border-bottom: orangered thick solid;">
                        @yield('content')
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 10px">
                        @include('../includes.email.email_footer')
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>



</html>