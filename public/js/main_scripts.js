/**
 * Created by jackmolnar1982 on 11/23/14.
 */

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


