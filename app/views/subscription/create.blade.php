@extends('layouts.default')

@section('content')

    <div class="subscription">

        <div class="col-md-9">

            <h1>Subscribe to a Plan</h1>

            <hr/>

            <p>Subscriptions allow you to post as many listings as you want based on the level you subscribe to. It allows for easy billing and convenient posting. A perfect option for larger companies and staffing agencies.</p>

            <ul class="list-group">
                @foreach($subscriptions as $plan => $subscriptionDetails)
                    <li class="list-group-item">
                        <div class="radio">
                            <label><input type="radio" name="plan" data-plan="{{ $plan }}" data-cost="{{ $subscriptionDetails['cost'] }}">
                                <b>{{ $plan }} Plan</b><br/>
                                <hr/>
                                Up to {{ $subscriptionDetails['listings'] }} Active Listings<br/>
                                Cancel at any time<br/>
                                <br/>
                                Only ${{ $subscriptionDetails['cost'] * .01 }} Per Month
                            </label>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="subscription_buton">
                {{ Form::open(['action' => 'SubscriptionController@store', 'method' => 'post', 'id' => 'subscribe']) }}

                {{-- if billing set to charge--}}
                @if(!Config::get('billing.free'))
                    {{-- Button container --}}
                    <span class="checkout_button" id="checkout_button" style="float: right"></span>
                    {{-- Hidden input to contain cost --}}
                    <input type="hidden" value="" id="cost" name="cost" />
                    <input type="hidden" value="" id="plan" name="plan" />
                @endif

                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop


@section('_title')
    Create New Job Listing - EriePaJobs
@stop

@section('scripts')

    <script>

        var costInput = $('#cost'),
            checkoutScript = $('#checkout_script'),
            checkoutButton = $('.checkout_button');

        $('input:radio').change(function(){

            // set the radio's data
            var cost = $(this).attr('data-cost'),
                plan = $(this).attr('data-plan');

            $.post( "button", { cost: cost, plan: plan }, function( data ) {
                checkoutButton.html( data );
            });

            $('#cost').val(cost);
            $('#plan').val(plan);

        });

    </script>

@stop