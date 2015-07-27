<div class="row process">
    <div class="container">
        <ul>
            <li class="{{ Request::path() == 'jobs/create' ? 'active' : '' }}"><i class="fa fa-pencil"></i> Create EriePaJobs Listing ></li>
            <li class="{{ Request::path() == 'jobs/create/review' ? 'active' : '' }}"><i class="fa fa-eye"></i> Review EriePaJobs Listing ></li>
            <li class="{{ Request::path() == 'jobs/create/reader' ? 'active' : '' }}"><i class="fa fa-pencil"></i> Create Erie Reader Ad ></li>
            <li class="{{ Request::path() == 'jobs/create/reader/review' ? 'active' : '' }}"><i class="fa fa-eye"></i> Review Erie Reader Ad ></li>
            <li class="{{ Request::path() == 'jobs/create/cart' ? 'active' : '' }}"><i class="fa fa-money"></i> Checkout</li>
        </ul>
    </div>
</div>
