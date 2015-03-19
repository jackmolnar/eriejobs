@extends('layouts.default')

@section('content')

<div class="container contact">

    <div class="col-md-6">

        <div class="well">
            <h1>Contact Us</h1>

            <hr/>

            {{ Form::open(['action' => 'PagesController@postContact']) }}

            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) }}

            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}

            {{ Form::label('phone', 'Phone') }}
            {{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Phone']) }}

            {{ Form::label('message', 'Message') }}
            {{ Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'Message']) }}

            <hr/>

            {{ Form::submit('Send', ['class' => 'btn btn-primary btn-sm']) }}

            {{ Form::close() }}
        </div>
    </div>

    <div class="col-md-6">
        <div class="well">
            <h2>We love mail.</h2>
            <hr/>
            <p>
                Feel free to contact us about anything. It's our goal to make this platform as useful as possible to everyone. If you have suggestions that could improve the website, we want to hear them!
            </p>
            <p>
                If you have issues using the website or any questions at all, don't hesitate to reach out to us. We're here to help!
            </p>
        </div>
    </div>

</div>
@stop
