<div class="well col-md-10">

    @include('includes.profiles.recruiter_sections.current_jobs')
    @include('includes.profiles.recruiter_sections.expired_jobs')

</div>

{{--@include('includes.profiles.recruiter_sections.subscription_info')--}}
@include('includes.profiles.recruiter_sections.general_info')

@if(count($user->jobs) > 0)
    @include('includes/modals/delete_modal')
@endif

@include('includes/modals/delete_account_modal')
@include('includes/modals/unsubscribe_modal')


