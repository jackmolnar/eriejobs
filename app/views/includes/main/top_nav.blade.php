<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
  <div class="container">
  <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        {{ link_to_action('PagesController@home', '', null, ['class' => 'navbar-brand']) }}
      </div>
    <ul class="nav navbar-nav">
      @if(Auth::user())
          @if(Auth::user()->role->title == 'Seeker')
              <li>{{ link_to_action('ProfilesController@index', 'Dashboard') }}</li>
              <li>{{ link_to_action('SearchController@index', 'Search Jobs') }}</li>
              <li>{{ link_to_action('BrowseController@index', 'Browse Jobs') }}</li>
          @elseif(Auth::user()->role->title == 'Recruiter')
              <li>{{ link_to_action('ProfilesController@index', 'Dashboard') }}</li>
              <li>{{ link_to_action('JobsController@create', 'Post a Job') }}</li>
          @endif
          <li>{{ link_to_action('AuthController@logout', 'Logout') }}</li>
      @else
        <li>{{ link_to_action('AuthController@getSeekerSignup', 'Signup') }}</li>
        <li>{{ link_to_action('AuthController@getSeekerLogin', 'Login') }}</li>
        <li>{{ link_to_action('PagesController@hiring', 'Hiring?') }}</li>
      @endif
    </ul>
  </div>
</nav>


