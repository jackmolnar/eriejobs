/**
 * Created by jackmolnar1982 on 11/23/14.
 */

/*
    Activate button
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
        });
});

/*
    Delete button
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
    Email / Link Radio Buttons
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
 Tool Tips
 */
$(function () {
    var confidentialOptions = {
        title: 'We still need your company name, city, and state. Checking this will post the listing confidentially when viewed by applicants.',
        placement: 'bottom'
    };
    $('#confidential').tooltip(confidentialOptions);
});





