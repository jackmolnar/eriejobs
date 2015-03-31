<div class=" footer">

    <div class="container">

        <div class="col-md-4 logo">
            <img src="{{ URL::asset('images/eriepajobs_3.png') }}" />
            <div class="copyright">
                Copyright <?php echo date("Y"); ?> EriePaJobs
                <br/>
                <br/>
                <img src="{{ URL::asset('images/RapidSSL_SEAL-90x50.gif') }}" />

            </div>
        </div>

        <div class="col-md-4 links">
            <ul>
                <li>{{ link_to_action('PagesController@home', 'Home') }}</li>
                <li>{{ link_to_action('AuthController@getSeekerSignup', 'Job Seeker Signup') }}</li>
                <li>{{ link_to_action('PagesController@hiring', 'Recruiter Signup') }}</li>
                <li>{{ link_to_action('SearchController@index', 'Search Jobs') }}</li>
                <li>{{ link_to_action('BrowseController@index', 'Browse Jobs') }}</li>
                {{--<li>{{ link_to_action('BlogController@index', 'Blog') }}</li>--}}
                <li>{{ link_to_action('PagesController@getContact', 'Contact') }}</li>
                <li>{{ link_to_action('PagesController@getTermsOfUse', 'Terms Of Use') }}</li>
            </ul>
        </div>

        <div class="col-md-4 social">
            <div class="social_container">
                <a class="facebook" href="https://www.facebook.com/eriepa.jobs" target="_blank"></a>
                <a class="twitter" href="https://twitter.com/EriePaJobsCom" target="_blank"></a>
                <a class="linkedin" href="https://www.linkedin.com/company/eriepajobs-com" target="_blank"></a>
            </div>
        </div>

    </div>

</div>