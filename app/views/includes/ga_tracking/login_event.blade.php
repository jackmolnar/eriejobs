@if(Session::get('logged_in'))
    <script>
        ga('send', 'event', 'auth', 'login');
    </script>
@endif