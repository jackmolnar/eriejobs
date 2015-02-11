


    {{ Form::label('title', 'Title', ['class' => 'required']) }}
    {{ Form::text('title', $job->title, ['class' => 'form-control', 'placeholder' => 'Job Title']) }}
    {{ Form::label('description', 'Description', ['class' => 'required']) }}
    {{ Form::textarea('description', $job->description, ['class' => 'form-control', 'placeholder' => 'Job Description']) }}
    <hr/>

    <div class="row">
        <div class="col-md-6">
            {{ Form::label('salary', 'Salary') }}
            {{ Form::text('salary', $job->salary, ['class' => 'form-control half_element', 'placeholder' => 'Salary']) }}

            {{ Form::label('type', 'Type', ['class' => 'required']) }}
            {{ Form::select('type', $types, $job->type->id, ['class' => 'form-control half_element']) }}
        </div>

        <div class="col-md-6">
            {{ Form::label('career_level', 'Career Level', ['class' => 'required']) }}
            {{ Form::select('career_level', $career_levels, $job->careerlevel->id, ['class' => 'form-control half_element']) }}
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-12">
        <h4>How would you like to receive applications?</h4>
        </div>
        <div class="col-md-6">
        <div class="radio">
            @if($job->email > '')
                <label>
                    {{ Form::radio('contact', 'email', true, ['id' => 'email_contact']) }}
                    Send applications to an email address.
                </label>
            @else
                <label>
                    {{ Form::radio('contact', 'email', false, ['id' => 'email_contact']) }}
                    Send applications to an email address.
                </label>
            @endif
        </div>
        <div class="radio">
            @if($job->link > '')
                <label>
                    {{ Form::radio('contact', 'link', true, ['id' => 'link_contact']) }}
                    Applicants should be directed to a webpage.
                </label>
            @else
                <label>
                    {{ Form::radio('contact', 'link', false, ['id' => 'link_contact']) }}
                    Applicants should be directed to a webpage.
                </label>
            @endif
        </div>
        </div>
        <div class="col-md-6">
            <span class="apply">
                @if($job->email > '')
                    {{ Form::label('email', 'Email') }}
                    {{ Form::text('email', $job->email, ['id' => 'email', 'placeholder' => 'Email', 'class' => 'form-control half_element']) }}
                @elseif($job->link > '')
                    {{ Form::label('link', 'Link') }}
                    {{ Form::text('link', $job->link, ['id' => 'link', 'placeholder' => 'Link', 'class' => 'form-control half_element']) }}
                @endif
            </span>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6">
            {{ Form::label('company_name', 'Company Name', ['class' => 'required']) }}
            {{ Form::text('company_name', $job->company_name, ['class' => 'form-control half_element', 'placeholder' => 'Company Name']) }}
            {{ Form::label('company_address', 'Address') }}
            {{ Form::text('company_address', $job->company_address, ['class' => 'form-control half_element', 'placeholder' => 'Address']) }}
            <div class="checkbox" id="confidential">
                <label>
                    {{ Form::checkbox('confidential', 1, $job->confidential, ['id' => 'confidential']) }}
                    Do you want to post this listing confidentially?
                </label>
            </div>
        </div>
        <div class="col-md-6">
            {{ Form::label('company_city', 'City', ['class' => 'required']) }}
            {{ Form::text('company_city', $job->company_city, ['class' => 'form-control half_element', 'placeholder' => 'City']) }}
            {{ Form::label('company_state', 'State', ['class' => 'required']) }}
            {{ Form::select('company_state', $states, $job->state->id, ['class' => 'form-control half_element']) }}
        </div>
    </div>
    <hr/>

    @if(!isset($job->id))
        {{--If pending job that is being created--}}

        {{ Form::label('category', 'Select a Category', ['class' => 'required']) }}
        {{ Form::select('category', $categories, $job->category, ['class' => 'form-control']) }}

    @else
        {{--If pending job that is being created--}}

        {{ Form::label('category', 'Select a Category', ['class' => 'required']) }}
        {{ Form::select('category', $categories, $job->categories->first()->id, ['class' => 'form-control']) }}
    @endif


