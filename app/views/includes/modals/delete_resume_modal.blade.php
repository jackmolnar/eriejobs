<!-- Modal -->
<div class="modal fade" id="deleteResumeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Resume Confirmation</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this resume? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                {{ link_to_action('ProfilesController@destroy_resume', 'Delete Resume', null, ['class' => 'btn btn-danger']) }}
            </div>
        </div>
    </div>
</div>
