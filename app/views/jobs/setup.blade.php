@extends('layouts.default')

@section('content')

    <div class="job_setup">

        <div class="col-md-12">
            <h1>Setup Your Listing</h1>
            <hr>
            <p>
                Here you can decide to post only online at EriePaJobs, only list in the ErieReader, or the best option that will give your listing the most exposure, <b>list on both EriePaJobs and in the ErieReader.</b>
            </p>
        </div>

        <div class="col-md-12 option_table">

        {{ Form::open(['action' => 'JobsController@storeSetup']) }}

        <table class="table table-striped">
            <tr>
                <td></td>
                <td class="heading"><h2>EriePaJobs Only</h2></td>
                <td class="heading"><h2>ErieReader Only</h2></td>
                <td class="heading highlight"><h2>Both EriePaJobs and ErieReader</h2></td>
            </tr>
            <tr>
                <td>3 Application Guarantee</td>
                <td><span class="checkmark"></span></td>
                <td></td>
                <td class="highlight"></td>
            </tr>
            <tr>
                <td>Promoted on Indeed</td>
                <td><span class="checkmark"></span></td>
                <td></td>
                <td class="highlight"><span class="checkmark"></span></td>
            </tr>
            <tr>
                <td>Emailed to Subscribers</td>
                <td><span class="checkmark"></span></td>
                <td></td>
                <td class="highlight"><span class="checkmark"></span></td>
            </tr>
            <tr>
                <td>Shared on Social Media</td>
                <td><span class="checkmark"></span></td>
                <td><span class="checkmark"></span></td>
                <td class="highlight"><span class="checkmark"></span></td>
            </tr>
            <tr>
                <td>Distributed in 12,000 Copies of the ErieReader</td>
                <td></td>
                <td><span class="checkmark"></span></td>
                <td class="highlight"><span class="checkmark"></span></td>
            </tr>
            <tr>
                <td>30 Cents Per Character</td>
                <td></td>
                <td><span class="checkmark"></span></td>
                <td class="highlight"></td>
            </tr>
            <tr>
                <td>25 Cents Per Character</td>
                <td></td>
                <td></td>
                <td class="highlight"><span class="checkmark"></span></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div class="radio">
                        <lable>{{ Form::radio('setup', 1, null) }} Select</lable>
                    </div>
                </td>
                <td>
                    <div class="radio">
                        <lable>{{ Form::radio('setup', 2, null) }} Select</lable>
                    </div>
                </td>
                <td class="highlight">
                    <div class="radio">
                        <lable>{{ Form::radio('setup', 3, null) }} Select</lable>
                    </div>
                </td>
            </tr>

        </table>

        </div>

        <div class="col-md-12">
            {{ Form::submit('Continue', ['class' => 'btn btn-lg btn-primary', 'style' => 'float:right;']) }}
        </div>
        {{ Form::close() }}



        {{--<div class="col-md-3 choice">--}}
            {{--<h2>List on EriePaJobs Only</h2>--}}
            {{--<hr>--}}
            {{--<ul>--}}
                {{--<li>Promoted on Indeed</li>--}}
                {{--<li>Shared on Social Media</li>--}}
                {{--<li>Eligible for 3 Application Guarantee</li>--}}
            {{--</ul>--}}
            {{--{{ Form::radio('setup', 'epj', null, ['class' => 'form-control']) }}--}}
        {{--</div>--}}
        {{--<div class="col-md-3 choice">--}}
            {{--<h2>List in ErieReader Only</h2>--}}
            {{--<hr>--}}
            {{--<ul>--}}
                {{--<li>Your Choice of Date</li>--}}
            {{--</ul>--}}
            {{--{{ Form::radio('setup', 'er', null, ['class' => 'form-control']) }}--}}
        {{--</div>--}}
        {{--<div class="col-md-3 choice">--}}
            {{--<h2>List on EriePaJobs and in the ErieReader</h2>--}}
            {{--{{ Form::radio('setup', 'epjer', null, ['class' => 'form-control']) }}--}}
        {{--</div>--}}

        {{--<div class="col-md-12">--}}
            {{--{{ Form::submit('Continue', ['class' => 'btn btn-primary']) }}--}}
        {{--</div>--}}

    </div>
@stop


@section('_title')
    Setup New Job Listing - EriePaJobs
@stop