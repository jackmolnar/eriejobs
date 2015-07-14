<!-- Modal -->
<div class="modal fade" id="unsubscribeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Cancel Subscription</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to cancel your subscription? This action cannot be undone. You're subscription will remain active until the end of your billing cycle.</p>
                <p>You can still post individual listings for the standard rate after canceling.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                {{ Form::open(['action' => ['SubscriptionController@destroy', $user->id], 'method' => 'delete']) }}
                {{ Form::submit('Cancel Subscription', ['class' => 'btn btn-danger']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
