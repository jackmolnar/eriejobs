<div class="add_search_term_notification">

    <?php if(isset($category['category']->category)) $term = $category['category']->category; ?>

    @if(!$notification)
        <i class="fa fa-envelope"></i> Get email notifications about new jobs related to "<span class="bold_search_term">{{ $term }}</span>"?
        <div style="margin-left:10px; display:inline; max-height: 100px;">
            <a  class="btn btn-default btn-sm notify_button" data-searchTerm="{{$term}}">Sign Me Up</a>
        </div>
    @else
        <i class="fa fa-envelope"></i> You're already signed up for email notifications related to "<span class="bold_search_term">{{ $term }}</span>"
        <div style="margin-left:10px; display:inline; max-height: 100px;">
            {{ link_to_action('ProfilesController@edit_notifications', 'Edit Notifications', null, ['class' => 'btn btn-default btn-sm']) }}
        </div>
    @endif
</div>

