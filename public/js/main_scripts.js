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


