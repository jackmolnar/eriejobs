@if(Session::has('success'))
<div class="alert alert-success success_box">
    {{ Session::get('success') }}
</div>
@endif