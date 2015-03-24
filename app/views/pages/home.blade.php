@extends('layouts.home_page')

@section('content')

<div class="main_back">
    <div class="container home_page">
        <div class="main_home">
             <h1>Northwestern Pennsylvania's Exclusive Employment Website</h1>
             <div class="home_buttons">
                 {{ link_to_action('AuthController@getSeekerSignup', 'Signup', null, ['class' => 'btn btn-primary btn-lg']) }}
                 <span>OR</span>
                 {{ link_to_action('AuthController@getLogin', 'Login', null, ['class' => 'btn btn-default btn-lg']) }}
             </div>
             <div class="hiring_buttons">
                Hiring? {{ link_to_action('PagesController@hiring', 'Signup for a Recruiter account') }} and post Free for the first 90 days.
             </div>
        </div>
    </div>
</div>

<div class="container section2">
    <div class="col-md-4">
        <h2>Find Jobs Posted By Area Employers</h2>
        <img src="../images/home_image_1.jpg" class="img-responsive">
        <p>All listings on EriePaJobs are posted by Northwestern Pennsylvania employers. You'll never have to sift through listings or ads posted by national companies that don't apply to you.
           <br/><br/>
           {{ link_to_action('SearchController@index', 'Search For Jobs', null, ['class' => 'btn btn-primary']) }}
        </p>
    </div>
    <div class="col-md-4">
        <h2>Locally Owned and Operated</h2>
        <img src="../images/home_image_2.jpg" class="img-responsive">
        <p>EriePaJobs is locally owned and operated. We have our ear to the ground when it comes to employment in Erie. We have a stake in matching top talent with the area's best employers.
           <br/><br/>
           {{ link_to_action('AuthController@getSeekerSignup', 'Sign Up and Apply For Jobs', null, ['class' => 'btn btn-primary']) }}
        </p>
    </div>
    <div class="col-md-4">
        <h2>Hiring? Post job listings free for 3 months.</h2>
        <img src="../images/home_image_3.jpg" class="img-responsive">
        <p>To kick off EriePaJobs, we're letting Erie area employers post job listings FREE for the first 90 days after our launch. Let us prove our value to you.
            <br/><br/>
           {{ link_to_action('PagesController@hiring', 'Sign Up and Find Your Next Employee', null, ['class' => 'btn btn-primary']) }}
            </p>
    </div>
</div>
@stop

@section('_title')
EriePaJobs - Northwestern Pennsylvania's Exclusive Employment Website
@stop
@section('_description')
EriePaJobs is an exclusive help-wanted and employment website for Erie and Northwestern PA. Job seekers can find career opportunities and recruiters can post job listings for available positions.
@stop