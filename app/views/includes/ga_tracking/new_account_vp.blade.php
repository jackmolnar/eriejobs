@if(Session::has('new_seeker_account'))
    <script>
        ga('send', {
            'hitType': 'pageview',
            'page': '/new-seeker-account',
            'title': 'New Seeker Account'
        });
    </script>
@endif

@if(Session::has('new_recruiter_account'))
    <script>
        ga('send', {
            'hitType': 'pageview',
            'page': '/new-recruiter-account',
            'title': 'New Recruiter Account'
        });
    </script>
@endif
