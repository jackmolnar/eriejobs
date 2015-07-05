<h3 class="info_header"><i class="fa fa-history"></i> Subscription Information</h3>

<div class="row">
    @if($user->subscribed())
        <div class="col-md-6">
            <b>Plan:</b> {{ $user->stripe_plan }}
        </div>
        <div class="col-md-6">
            <b>Remaining Available Listings:</b> {{ $user->listingsLeft }}
            <button class="btn btn-default btn-xs unsubscribe_button" data-toggle="modal" data-target="#unsubscribeModal">Cancel Subscription</button>
        </div>
    @else
        <p>You aren't currently subscribed to a plan.</p>
        <ul>
            <li>Subscribe and post as many listings as you want up to your limit</li>
            <li>Convent for teams, staffing agencies, and larger companies</li>
            <li>Only enter billing in formation once and get charged monthly</li>
            <li>Cancel at any time - no questions asked</li>
        </ul>
        {{ link_to_action('SubscriptionController@create', 'Subscribe', null, ['class' => 'btn btn-primary']) }}
    @endif
</div>
