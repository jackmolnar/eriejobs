@extends('layouts.default')

@section('content')

    <div class="jobs">

        <h1 style="display: block"><i class="fa fa-shopping-cart"></i> Cart</h1>

        <div class="well col-md-9 ">
            @if($user->subscribed())
                <h3 style="margin-bottom: 30px">Available Subscription Listings: {{ $listingsLeft }}</h3>
            @endif

            <table class="table">
                <tr>
                    <th>Listing</th>
                    <th>Expire Date</th>
                    <th>Cost</th>
                    <th>Edit Job</th>
                    <th>Remove from Cart</th>
                </tr>
                @foreach($cart as $index => $job)
                    <tr>
                        <td>{{{ $job->title }}}</td>
                        <td>{{{ $job->expire->format( 'm-d-Y') }}}</td>
                        @if($listingsLeft > 0)
                            <td>${{{ 0 * .01 }}}</td>
                        @else
                            <td>${{{ \Config::get('billing')['listings'][\Carbon\Carbon::today()->diffInDays($job->expire)] * .01 }}}</td>
                        @endif
                        <td>{{ link_to_action('JobsController@create', 'Edit', ['id' => $index], ['class' => 'btn btn-xs btn-warning']) }}</td>
                        <td>{{ link_to_action('JobsController@deleteCart', 'Delete', ['id' => $index], ['class' => 'btn btn-xs btn-danger']) }}</td>
                    </tr>
                    {{-- Iterate listings left--}}
                    <?php $listingsLeft-- ?>
                @endforeach
                <tr>
                    <td colspan="5">Total Cost: ${{ $cost*.01 }}.00</td>
                </tr>
            </table>

            <hr/>
            <div class="row">
                {{ Form::open(['action' => 'JobsController@payment', 'method' => 'post']) }}

                {{-- if billing set to charge--}}
                @if(!Config::get('billing.free') && $cost > 0)
                    <span class="checkout_button" style="float: right">
                    <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="{{ getenv('STRIPE_PUBLISHABLE_KEY') }}"
                    data-image=""
                    data-name="EriePaJobs.com"
                    data-description="{{ count($cart) }} Listing(s)"
                    data-amount="{{ $cost }}"
                    data-email="{{ $user->email }}"
                    data-label="Pay For Listings"
                    data-allow-remember-me="false"
                            >
                    </script>
                    </span>
                    {{ Form::hidden('cost', $cost) }}
                    {{ link_to_action('JobsController@create', 'Add Another Job', null, ['class' => 'btn btn-default']) }}
                @else
                    {{-- if billing set to free--}}
                    {{ link_to_action('JobsController@create', 'Add Another Job', null, ['class' => 'btn btn-default']) }}

                    {{ Form::submit('Post Listings', ['class' => 'btn btn-primary']) }}
                @endif
                {{ Form::close() }}

                <hr/>
                <h3>Interested in subscription pricing?</h3>
                <p>Pay by an automatic monthly subscription and post several jobs at a time. Both convenient and cheaper than individual listings!</p>
                {{ link_to_action('SubscriptionController@create', 'Subscribe', null, ['class' => 'btn btn-warning']) }}

            </div>
        </div>
        <div class="col-md-3">
            <div class="well well-primary">
                <ul>
                    <li>Our payment processing is secure! We use 256 bit encryption and process all payments through one of the most secure payment gateways in the world, {{ link_to('https://stripe.com/', 'Stripe', ['target' => '_blank']) }}</li>
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