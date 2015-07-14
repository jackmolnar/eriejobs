<div class="well col-md-10">

    <h3 class="subscription_header"><i class="fa fa-history"></i> Subscription Information</h3>

    @if($user->onGracePeriod())
        <div class="subscription_alert alert alert-danger">
            Your subscription is currently canceled and expires on {{ $user->subscription_ends_at->toFormattedDateString() }}
            &nbsp;&nbsp;&nbsp;
            {{--{{ link_to_action('SubscriptionController@store', 'Resubscribe', ['plan' => $user->stripe_plan ], ['class' => 'btn btn-default btn-xs']) }}--}}
        </div>
    @endif


    @if($user->subscribed())
        <div class="row" style="clear: left">
            <div class="col-md-6">
                <b>Plan:</b> {{ $user->stripe_plan }}
            </div>
            <div class="col-md-6">
                <b>Remaining Available Listings:</b> {{ $user->listingsLeft }}
            </div>
        </div>
        <div class="row">
            @if ($user->subscribed() && !$user->cancelled())
                <div class="col-md-12">
                    <button class="btn btn-default btn-xs unsubscribe_button" data-toggle="modal" data-target="#unsubscribeModal">Cancel Subscription</button>
                </div>
            @endif
        </div>
    @else
        <div class="row">
            <div class="col-md-12">
                <p>You aren't currently subscribed to a plan.</p>
                <ul>
                    <li>Subscribe and post as many listings as you want up to your limit</li>
                    <li>Convenient for teams, staffing agencies, and larger companies</li>
                    <li>Only enter billing information once and get charged monthly</li>
                    <li>Cancel at any time - no questions asked</li>
                </ul>
                {{ link_to_action('SubscriptionController@create', 'Subscribe', null, ['class' => 'btn btn-primary', 'style' => 'float:right']) }}
            </div>
        </div>
    @endif

</div>