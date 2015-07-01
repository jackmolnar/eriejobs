@extends('layouts.default')

@section('content')

<div class="jobs">

    <h1 style="display: block">Review Your Listing</h1>

    <div class="well col-md-9 ">
        <div class="row">
            <h1>{{ $pending_job->title }}</h1>
            <hr/>
            <h3>{{ $pending_job->company_name }}</h3>
        </div>
        <hr/>
        <div class="row job_data">
            <ul>
                <li>{{ Form::label('type', 'Type:') }} {{ $pending_job->type->type }}</li>
                <li>{{ Form::label('salary', 'Salary:') }} {{ $pending_job->salary }}</li>
                <li>{{ Form::label('level', 'Career Level:') }} {{ $pending_job->careerlevel->level }}</li>
                <li>{{ Form::label('category', 'Category:') }} {{ $categories[$pending_job->category_id] }}</li>
            </ul>
        </div>
        <hr/>
        <div class="row">
            <h3 style="margin-bottom: 25px">Job Description</h3>
            {{ $pending_job->description }}
        </div>
        <hr/>
        <div class="row location_data">
            <div class="col-md-6">
                <h3 style="margin-bottom: 25px">Location</h3>
                <ul>
                    <li>{{ Form::label('company_address', 'Address:') }} {{ $pending_job->company_address }}</li>
                    <li>{{ Form::label('company_city', 'City:') }} {{ $pending_job->company_city }}</li>
                    <li>{{ Form::label('company_state', 'State:') }} {{ $pending_job->state->title }}</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h3 style="margin-bottom: 25px">Contact and Length</h3>
                <ul>
                    @if($pending_job->email != '')
                        <li>
                            {{ Form::label('email', 'Email Address Applications Should Be Sent To:') }}
                            <br/>
                            {{ $pending_job->email }}
                        </li>
                    @elseif($pending_job->link != '')
                        <li>
                            {{ Form::label('link', 'Link Applicants Should Be Directed To:') }}
                            <br/>
                            {{ $pending_job->link }}
                        </li>
                    @endif
                    <li>
                        {{ Form::label('expire', 'Listing Will Expire On:') }}
                         <br/>
                         {{ $pending_job->expire->toDayDateTimeString() }}
                    </li>
                    <li>
                        {{ Form::label('confidential', 'Confidential Listing?') }}
                        <br/>
                        @if($pending_job->confidential)
                            Yes
                        @else
                            No
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <hr/>
        <div class="row">
            {{ Form::open(['action' => 'JobsController@payment', 'method' => 'post']) }}
            {{ link_to_action('JobsController@create', 'Edit', null, ['class' => 'btn btn-warning']) }}

            @if(!Config::get('billing.free'))
                <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="pk_test_G59xaf43g03xVDXtwrZQ2ByW"
                    data-image=""
                    data-name="EriePa Jobs"
                    data-description="{{ $length }}"
                    data-amount="{{ $cost }}">
                </script>
                {{ Form::hidden('cost', $cost) }}
            @else
                {{ Form::submit('Post Listing', ['class' => 'btn btn-primary']) }}
            @endif
            {{ Form::close() }}

            {{--<a id="payment_button" class="btn btn-primary">Confirm and Pay</a>--}}
            {{--{{ link_to_action('JobsController@payment', 'Continue', null, ['class' => 'btn btn-primary']) }}--}}
        </div>
    </div>
    <div class="col-md-3">
        <div class="well well-primary">
            <ul>
                <li>EriePaJobs is secure! We use 256 bit encryption and one of the safest payment gateways in the world.</li>
                <li>If you have questions or problems, feel free to {{ link_to_action('PagesController@getContact', 'contact us') }}</li>
            </ul>
        </div>
    </div>

</div>

@stop

@section('scripts')
<script>
/*
    Checkout Button
 */

var handler = StripeCheckout.configure({
    key: 'pk_test_G59xaf43g03xVDXtwrZQ2ByW',
    token: function(token) {
        // Use the token to create the charge with a server-side script.
        // You can access the token ID with `token.id`
        $.post('payment', { stripeToken: token })
            .done(function( data ){
                alert(data)
            });
    }
});

$('#payment_button').on('click', function(e) {
    // Open Checkout with further options
    console.log('payment clicked');
    handler.open({
        name: 'EriePa Jobs',
        description: 'Job Listing',
        amount: 2000
    });
    e.preventDefault();
    });

// Close Checkout on page navigation
$(window).on('popstate', function() {
    handler.close();
    });


</script>
@stop

@section('_title')
    Review Your New Job Listing - EriePaJobs
@stop