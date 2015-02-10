@extends('layouts.email_template')

@section('content')

    <h2>New Message From {{ $name }}</h2>
    <hr/>

    <h4>Email: {{ $email }}</h4>

    <h4>Phone: {{ $phone }}</h4>

    <hr/>

    <p>{{ $body }}</p>

@stop