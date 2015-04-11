@if(Session::has('new_seeker_account'))
    <script>
        ga('send', {
            'hitType': 'pageview',
            'page': '/new-seeker-account',
            'title': 'New Seeker Account'
        });
    </script>

    <!-- Facebook Conversion Code for EPJ Seeker Registrations -->
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
        })();
        window._fbq = window._fbq || [];
        window._fbq.push(['track', '6022559436105', {'value':'0.00','currency':'USD'}]);
    </script>
    <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6022559436105&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>

    <!-- Google Code for Seeker Signup Conversion Page -->
    <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 967835416;
        var google_conversion_language = "en";
        var google_conversion_format = "3";
        var google_conversion_color = "ffffff";
        var google_conversion_label = "Br4xCLm-jVsQmP6_zQM";
        var google_remarketing_only = false;
        /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
        <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/967835416/?label=Br4xCLm-jVsQmP6_zQM&amp;guid=ON&amp;script=0"/>
        </div>
    </noscript>

@endif

@if(Session::has('new_recruiter_account'))
    <script>
        ga('send', {
            'hitType': 'pageview',
            'page': '/new-recruiter-account',
            'title': 'New Recruiter Account'
        });
    </script>

    <!-- Facebook Conversion Code for EPJ Recruiter Registrations -->
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
        })();
        window._fbq = window._fbq || [];
        window._fbq.push(['track', '6022634491705', {'value':'0.00','currency':'USD'}]);
    </script>
    <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6022634491705&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>

    <!-- Google Code for Recruiter Signup Conversion Page -->
    <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 967835416;
        var google_conversion_language = "en";
        var google_conversion_format = "3";
        var google_conversion_color = "ffffff";
        var google_conversion_label = "mEFbCMTs91oQmP6_zQM";
        var google_remarketing_only = false;
        /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
        <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/967835416/?label=mEFbCMTs91oQmP6_zQM&amp;guid=ON&amp;script=0"/>
        </div>
    </noscript>

@endif
