<!-- Modal -->
<div class="modal fade" id="verifyPhoneModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add and Verify Your Mobile Number</h4>
            </div>
            <div class="modal-body" id="verify_modal_body">
                <div id="enter_phone_number">
                    We must verify your phone number so that you can receive SMS text message notifications. Enter your phone number below then click send.
                    <hr/>
                    <div class="phone_number">
                        {{ Form::label('phone_number', 'Mobile Phone Number') }}<br/>
                        {{ Form::text('phone_number', '', ['class' => 'form-control', 'id' => 'phoneNumber', 'placeholder' => 'xxx-xxx-xxxx', 'style' => 'max-width: 150px; display: inline; margin-right: 15px']) }}
                        <button class="btn btn-default btn-sm" id="sendSmsVerification" data-userId="{{ $user->id }}">Send Verification Code</button>
                    </div>
                    <b style="font-size: 10px" id="validPhoneStatus">Format: xxx-xxx-xxxx</b>
                </div>
                <div id="enter_verification_code" style="display: none">
                    Now enter the 6 digit number that we sent to your mobile device to verify your mobile number.
                    <hr/>
                    <div class="verify_code">
                        {{ Form::label('verify_code', 'Verification Code') }}<br/>
                        {{ Form::text('verify_code', '', ['class' => 'form-control', 'id' => 'verifyCode', 'placeholder' => 'xxxxxx', 'style' => 'max-width: 150px; display: inline; margin-right: 15px']) }}
                        <button class="btn btn-default btn-sm" id="verifyMobileNumberButton" data-userId="{{ $user->id }}">Verify Your Phone</button>
                    </div>
                </div>
                <b style="font-size: 14px" id="validPhoneResult"></b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>