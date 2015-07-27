@extends('layouts.default')

@section('content')

<div class="job_create">

    <div class="col-md-9">
    <h1>Create Erie Reader Ad</h1>
    <hr/>

{{ Form::open(['action' => 'JobsController@readerStore']) }}

    @if(isset($pendingJob))

        {{ Form::label('Title') }}
        {{ Form::text('title', $pendingJob->title, ['class' => 'form-control', 'placeholder' => 'Title']) }}


        {{ Form::label('Description') }}
        {{ Form::textarea('description', strip_tags($pendingJob->description), [
            'class' => 'form-control job_description',
            'placeholder' => 'Content',
            'v-on' => 'keyup: recalculate',
            'v-model' => 'description'
            ]) }}

    @else

        {{ Form::label('Title') }}
        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) }}

        {{ Form::label('Description') }}
        {{ Form::textarea('description', null, [
            'class' => 'form-control job_description',
            'placeholder' => 'Content',
            'v-on' => 'keyup: recalculate',
            'v-model' => 'description'
            ]) }}

    @endif

        {{ Form::label('Available Publish Dates') }}
        {{ Form::select('pubDate', $readerPubDates, null, ['class' => 'form-control']) }}

        {{--{{ Form::label('Select Heading') }}--}}
        {{--{{ Form::select('heading', $readerHeadings, null, ['class' => 'form-control']) }}--}}

        <hr/>
        {{ link_to_action('JobsController@review', '< Review EriePaJobs Listing', null, ['class' => 'btn btn-default']) }}
        {{ Form::submit('Review Erie Reader Ad >', ['class' => 'btn btn-primary', 'style' => 'float:right']) }}

{{ Form::close() }}

    </div>

    <div class="col-md-3 job_info">

        <div class="well well-primary">
            <div>
                All ads are in column ads. If you would like a display ad that you designed or if you would like us to design one, please {{ link_to_action('PagesController@getContact', 'contact us') }}. We can accommodate custom requests.
                <hr/>
                You get up to 500 characters included in your ad. Additional characters are @{{ costPerCharacter | currency }} per character.
                <hr/>
                <h4>Character Count: @{{ characterCount }}</h4>
                <h4>Additional Cost: @{{ additionalCost | currency }}</h4>
                <h4>Total Cost: @{{ totalCost | currency }}</h4>
                <input type="hidden" value="{{ Config::get('billing.reader.costPerCharacter') }}" v-model="costPerCharacter"/>
                <input type="hidden" value="{{ Config::get('billing.reader.baseCost') }}" v-model="baseCost"/>
                <input type="hidden" value="{{ Config::get('billing.reader.freeCharacters') }}" v-model="freeCharacters"/>
                <hr/>
            </div>
            <ul>
                <li>
                    <img src="{{ URL::asset('images/RapidSSL_SEAL-90x50.gif') }}" /><br/><br/>
                    <img src="{{ URL::asset('images/stripe.png') }}" /><br/><br/>
                </li>
                <li>If you have questions or problems, feel free to {{ link_to_action('PagesController@getContact', 'contact us') }}</li>
            </ul>
        </div>

    </div>

</div>
@stop

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.7/vue.min.js"></script>
    <script src="/js/app.js"></script>
@stop

@section('_title')
    Create New Job Listing - EriePaJobs
@stop

@section('main_row')
    @include('includes.jobs.job_nav')
@stop