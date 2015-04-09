/**
 * Created by jackmolnar1982 on 11/23/14.
 */
$( document ).ready(function() {
    $(".success_box").delay( 1000).slideUp( 400 )
});


/*
    Activate button on recruiter dashboard page
 */
var activate_button = $(".activate_button");

activate_button.on('click', function(event) {

    event.preventDefault();

    var thisButton = $(this),
        jobId = thisButton.attr('data-jobid'),
        active = thisButton.attr('data-active'),
        text = ['Inactive', 'Active'];

    active = active === '0' ? active = 1 : active = 0;

    $.post('jobs/active', { active: active, jobid: jobId })
        .done(function( data ){
            thisButton.toggleClass('active').html(text[active]);
            thisButton.attr('data-active', active);
            console.log(data);
        });
});

/*
    Delete button on recruiter dashboard page
 */

var delete_button = $(".delete_button");

delete_button.on('click', function(){

    var jobid = $(this).attr('data-jobid'),
        jobTitle = $('.title-'+jobid).html(),
        deleteForm = $('.delete-form'),
        defaultAction = deleteForm.attr('action');


    $('.modal-listing').html(jobTitle);

    var value = defaultAction.substring(defaultAction.lastIndexOf('/') + 1);
    var newAction = defaultAction.replace(value, jobid);

    deleteForm.attr('action', newAction);

});


/*
    SMS / Phone Number Verification Stuff
 */

// set up variables
var smsCheckbox = $('#sms_checkbox'),
    smsVerifyModal = $('#verifyPhoneModal'),
    enterPhoneNumberPrompt = $('#enter_phone_number'),
    enterVerificationCodePrompt = $('#enter_verification_code'),
    smsSendVerifyButton = $('#sendSmsVerification'),
    verifyMobileNumberButton = $('#verifyMobileNumberButton'),
    userId = smsSendVerifyButton.attr('data-userId'),
    phoneNumberInput = $('#phoneNumber'),
    verificationCodeInput = $('#verifyCode'),
    validPhoneStatus = $('#validPhoneStatus'),
    validPhoneResult = $('#validPhoneResult');

// if edit phone button on page, add function
if ($('#edit_phone_number_button').length ) {
    var editPhoneNumberButton = $('#edit_phone_number_button');
    editPhoneNumberButton.on('click', function(){
        smsVerifyModal.modal('show')
    });
}

// show modal if SMS checkbox is checked or if phone number should be edited
smsCheckbox.change(function(){
    if( $(this).is(':checked') && !$('#user_verified_phone_number').length ) smsVerifyModal.modal('show')
});

// start the verify process - send verify code button
smsSendVerifyButton.on('click', function(){

    var phoneNumber = phoneNumberInput.val();

    // if valid phone number
    if ( validatePhone(phoneNumber) ) {
        validPhoneStatus.html('Valid phone number.').css('color', 'green');
        phoneNumber = phoneNumber.replace(/-/g, "").replace("(", "").replace(")", "").replace(" ", "");
        phoneNumber = '1' + phoneNumber;

        $.post('send-verification-code', { userId: userId, phoneNumber: phoneNumber })
            .done(function( data ){
                console.log(data);

                enterPhoneNumberPrompt.css('display', 'none');
                enterVerificationCodePrompt.css('display', 'inherit');
            });

    } else {
        validPhoneStatus.html('Invalid phone number.').css('color', 'red');
    }
});

// check if the verify code matches - verify mobile button
verifyMobileNumberButton.on('click', function(){

    var verificationCode = verificationCodeInput.val();

    if ( validateVerificationCode(verificationCode) ) {
        $.post('verify-phone-number', { userId: userId, verificationCode: verificationCode })
            .done(function(data){
                validPhoneResult.html(data['message']);
                if(data['status']) {
                    validPhoneResult.css('color', 'green');
                    enterVerificationCodePrompt.css('display', 'none');
                    location.reload(true);
                } else {
                    validPhoneResult.css('color', 'red');
                }
        });
    } else {
        validPhoneResult.html('You must enter a six digit code.').css('color', 'red');
    }
});

// sms verify hide modal event
smsVerifyModal.on('hide.bs.modal', function(){
    // if validation does not pass, or not attempted, uncheck box
    if(validPhoneResult.css('color') == 'red' || !$('#user_verified_phone_number').length) smsCheckbox.attr('checked', false);
});

// validate phone
function validatePhone(inputtxt) {
    var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
    return (inputtxt.match(phoneno))
}
// validate verification code
function validateVerificationCode(verificationCode){
    var filter = /^(\s*\d{6}\s*)(,\s*\d{6}\s*)*,?\s*$/;
    return filter.test(verificationCode);
}

/*
    Email / Link Radio Buttons on create job form
 */

var emailButton = $('#email_contact'),
    linkButton = $('#link_contact'),
    applyBox = $('.apply');

emailButton.change(function(){
    applyBox.html('<label for="email">Email Address</label><input class="form-control half_element" placeholder="Email" name="email" type="text" id="email">');
});

linkButton.change(function(){
    applyBox.html('<label for="link">Link</label><input class="form-control half_element" placeholder="Link" name="link" type="text" id="link">');
});





/*
 Default / New resume radio buttons on application create form
 */

var defaultResume = $('#default_resume'),
    newResume = $('#new_resume'),
    newResumeUploadBox = $('#new_resume_upload');

defaultResume.change(function(){
    newResumeUploadBox.html('');
});

newResume.change(function(){
    newResumeUploadBox.html('<p>Browse for your resume. Files must be PDF or Word files and smaller than 6mb in size.</p><input name="resume" type="file">');
});

/*
    Replace apply buttons with loader on click
 */

$('.apply_buttons input').on('click', function(){
    $('.apply_buttons').css("display", "none");
    $('.loader').html('Sending ... <img src="'+getBaseURL()+'images/loader.gif" style="max-height: 30px;" />');
});

/*
    Save search term email notification button
 */

var notifyButton = $(".notify_button");

notifyButton.on('click', function(event) {

    event.preventDefault();

    var thisButton = $(this),
        container = thisButton.parent(),
        searchTerm = thisButton.attr('data-searchTerm'),
        loadingImage = getBaseURL()+'images/loader.gif';

    container.html("<img src='"+loadingImage+"' style='max-height: 30px;' />");

    $.post(getBaseURL()+'notifications/create', { searchTerm: searchTerm  })
        //console.log(searchTerm)
        .done(function( data ){
            console.log(data);
            container.html(data);
        });
});

/*
 Tool Tips
 */
$(function () {
    var confidentialOptions = {
        title: 'We still need your company name, city, and state. Checking this will post the listing confidentially when viewed by applicants.',
        placement: 'bottom'
    };
    $('#confidential').tooltip(confidentialOptions);
});




/*
 Get the root URL
 */
function getBaseURL() {
    var url = location.href;  // entire url including querystring - also: window.location.href;
    var baseURL = url.substring(0, url.indexOf('/', 14));

    if (baseURL.indexOf('http://localhost') != -1) {
        // Base Url for localhost
        var url = location.href;  // window.location.href;
        var pathname = location.pathname;  // window.location.pathname;
        var index1 = url.indexOf(pathname);
        var index2 = url.indexOf("/", index1 + 1);
        var baseLocalUrl = url.substr(0, index2);

        return baseLocalUrl + "/";
    }
    else {
        // Root Url for domain name
        return baseURL + "/";
    }
}




// Get the template HTML and remove it from the document
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/store-permanent-application", // Set the url
    maxFilesize: 6,
    paramName: 'resume',
    acceptedFiles: '.pdf,.doc,.docx',
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".upload_button" // Define the element that should be used as click trigger to select files.
});

myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
});

// Update the total progress bar
myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector(".progress-bar").style.width = progress + "%";
});

myDropzone.on("sending", function(file) {
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
});

myDropzone.on("complete", function(file){
    console.log(file.xhr.response);
    var response = file.xhr.response;
    $(".dz-complete").html(response);
    location.reload();

});


// Setup the buttons for all transfers
// The "add files" button doesn't need to be setup because the config
// `clickable` has already been specified.
document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
};
document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true);
};


