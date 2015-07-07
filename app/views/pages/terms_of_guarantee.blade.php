@extends('layouts.default')

@section('content')

    <div class="container contact">

        <div class="col-md-8">

            <h1>Terms Of 3 Application Guarantee</h1>

            <hr/>

            <img src="{{ url('images/guarantee.png') }}" alt="5 Application Guarantee"/><br/><br/><br/>

            <p>
                The 3 application guarantee is only applicable to regular one-time postings of either 30 or 60 days in length.
            </p>
            <p>
                Listings must remain active for at least 30 days. Listings deactivated or deleted are not eligible.
            </p>
            <p>
                The guarantee only applies to listings where applications are directed to an email address. Applicants directed to a URL are not eligible.
            </p>
            <p>
                The guarantee is only valid if the job posting does not include contact information directly in the job description or anywhere else in the ad. This includes prompting applicants to respond via email addresses, physical addresses, phone number, or in person applications.
            </p>
            <p>
                Job listings that include alternate forms of contact other than applying through EriePaJobs.com will not be refunded.
            </p>
            <p>
                If you have questions about the terms of the 3 Application Guarantee, please {{ link_to_action('PagesController@getContact', 'contact us.') }}
            </p>
        </div>
    </div>

@stop
