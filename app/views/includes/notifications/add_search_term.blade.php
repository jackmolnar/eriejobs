<div class="add_search_term_notification">

    <?php
        if(isset($category['category']->category))
        {
            $term = $category['category']->category;
        }
    ?>

        <i class="fa fa-envelope"></i> Get email notifications about new jobs related to "<span class="bold_search_term">{{ $term }}</span>"?
        {{--{{ Form::checkbox('notification', true, null, ['id' => 'search_notification_checkbox']) }}--}}
        <div style="margin-left:10px; display:inline; max-height: 100px;">
            <a  class="btn btn-default btn-sm notify_button" data-searchTerm="{{$term}}">Sign Me Up</a>
        </div>
</div>

