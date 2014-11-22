@extends('layouts.home_page')

@section('content')

<div class="main_back">
    <div class="container home_page">
        <div class="main_home">
             <h1>Northwestern Pennsylvania's Exclusive Employment Website</h1>
             <div class="home_buttons">
                 {{ link_to_action('AuthController@getSeekerSignup', 'Signup', null, ['class' => 'btn btn-primary btn-lg']) }}
                 <span>OR</span>
                 {{ link_to_action('AuthController@getSeekerLogin', 'Login', null, ['class' => 'btn btn-default btn-lg']) }}
             </div>
        </div>
    </div>
</div>
@stop
