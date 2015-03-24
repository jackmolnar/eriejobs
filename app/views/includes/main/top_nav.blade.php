<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
  <div class="container">
  <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
          <span >NAV</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        {{ link_to_action('PagesController@home', '', null, ['class' => 'navbar-brand']) }}
        </div>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
              @if(Auth::user())
                  @if(Auth::user()->role->title == 'Seeker')
                      <li><a href="{{ URL::action('ProfilesController@index') }}"><i class="fa fa-list"></i> Dashboard</a></li>
                      <li><a href="{{ URL::action('SearchController@index') }}"><i class="fa fa-search"></i> Search</a></li>
                      <li><a href="{{ URL::action('BrowseController@index') }}"><i class="fa fa-eye"></i> Browse</a></li>
                  @elseif(Auth::user()->role->title == 'Recruiter')
                        <li><a href="{{ URL::action('ProfilesController@index') }}"><i class="fa fa-list"></i> Dashboard</a></li>
                        <li><a href="{{ URL::action('JobsController@create') }}"><i class="fa fa-pencil"></i> Post Job</a></li>
                  @endif
                  {{--<li>{{ link_to_action('AuthController@logout', 'Logout') }}</li>--}}
                  <li><a href="{{ URL::action('AuthController@logout') }}"><i class="fa fa-remove"></i> Logout</a></li>
              @else
                <li>{{ link_to_action('AuthController@getSeekerSignup', 'Signup') }}</li>
                <li>{{ link_to_action('AuthController@getLogin', 'Login') }}</li>
                <li>{{ link_to_action('PagesController@hiring', 'Hiring?', null, ['class' => 'hiring_button']) }}</li>
              @endif
            </ul>
        </div>
      </div>
  </div>
</nav>


