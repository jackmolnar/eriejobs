@extends('layouts.default')

@section('content')

<div class="job_create">

    <div class="col-md-9">
    <h1>Create ErieReader Listing</h1>
    <hr/>

{{ Form::open(['action' => 'JobsController@readerStore']) }}

    @if(isset($pendingJob))

        {{ Form::label('Title') }}
        {{ Form::text('title', $pendingJob->title, ['class' => 'form-control', 'placeholder' => 'Title']) }}


        {{ Form::label('Description') }}
        {{ Form::textarea('description', strip_tags($pendingJob->description), [
            'class' => 'form-control job_description',
            'placeholder' => 'Description',
            'v-on' => 'keyup: recalculate',
            'v-model' => 'description'
            ]) }}

    @else

        {{ Form::label('Title') }}
        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) }}

            {{ Form::textarea('description', null, [
                'class' => 'form-control job_description',
                'placeholder' => 'Description',
                'v-on' => 'keyup: recalculate',
                'v-model' => 'description'
                ]) }}

    @endif

        {{ Form::label('Available Publish Dates') }}
        {{ Form::select('pubDate', $readerPubDates, null, ['class' => 'form-control']) }}

{{ Form::close() }}

    </div>

    <div class="col-md-3 job_info">

        <div class="well well-primary" data-spy="affix" data-offset-top="10" data-offset-bottom="300">
            <div>
                You get up to 500 characters included in your ad. Additional characters are an additional @{{ costPerCharacter | currency }} per character.
                {{--<h2>Total Cost: @{{ totalCost | currency }}</h2>--}}
                <hr/>
                <h4>Character Count: @{{ characterCount }}</h4>
                {{--<h4>Cost Per Character: $.<span id="costPerCharacter">{{ Config::get('billing.reader.cost.'.Session::get('pending_job.setup')) }}</span></h4>--}}
                <h4>Additional Cost: @{{ additionalCost | currency }}</h4>
                <h4>Total Cost: @{{ totalCost | currency }}</h4>
                <hr/>
            </div>
            <ul>
                {{-- Only return guarantee if setup is 1 --}}
                @if(Session::get('pending_job.setup') == 1)
                    <li id="guarantee"><img src="{{ url('images/guarantee.png') }}" alt="5 Application Guarantee" style="max-width: 200px"/><br/><br/>
                        We guarantee our listings! If you don't receive 3 applications when your listing expires, we'll refund you!
                        View the {{ link_to_action('PagesController@getTermsOfGuarantee', 'full terms here.', null, ['target' => '_blank']) }}
                    </li>
                @endif
                <li><img src="{{ URL::asset('images/RapidSSL_SEAL-90x50.gif') }}" /><br/><br/>
                    EriePaJobs is secure! We use 256 bit encryption and process all payments through one of the most secure payment gateways in the world, {{ link_to('https://stripe.com/', 'Stripe', ['target' => '_blank']) }}</li>

                <li>Be sure that the email address or web link that you wish to direct applicants to are valid, or you may not receive applications!</li>
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