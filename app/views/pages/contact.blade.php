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

</div>
@stop
