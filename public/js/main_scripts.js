/**
 * Created by jackmolnar1982 on 11/23/14.
 */


var activate_button = $(".activate_button");

activate_button.on('click', function(event) {

    event.preventDefault();

    var thisButton = $(this),
        jobId = thisButton.attr('data-jobid'),
        active = thisButton.attr('data-active'),
        text = ['Inactive', 'Active'];

    if (active === '0') {
        active = 1;
    } else {
        active = 0;
    }

    $.post('jobs/active', { active: active, jobid: jobId })
        .done(function( data ){
            thisButton.toggleClass('active').html(text[active]);
            thisButton.attr('data-active', active);
        });
});

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

    console.log(newAction);

});
