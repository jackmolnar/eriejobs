{{ '<?xml version="1.0" encoding="utf-8"?>'  }}

<jobs>
    @foreach($jobs as $job)
    <job>
        <title><![CDATA[{{ $job->title }}]]></title>
        <job-board-name>EriePaJobs</job-board-name>
        <job-board-url>https://eriepajobs.com</job-board-url>
        <job-code>{{$job->id}}</job-code>
        <detail-url>{{ action('JobsController@show', $job->slug)  }}</detail-url>
        <apply-url>
            @if(isset($job->email) && $job->email != '')
                {{ action('ApplicationsController@create', $job->slug)  }}
            @elseif(isset($job->link) && $job->link != '')
                {{ $job->link }}
            @endif
        </apply-url>
        <job-category><![CDATA[{{ $job->categories->first()->title }}]]</job-category>
        <description>
            <summary>
                <![CDATA[
                {{ $job->description }}
                ]]>
            </summary>
            @if($job->type->type == 'Full Time')
                <full-time>1</full-time>
            @elseif($job->type->type == 'Part Time')
                <part-time>1</part-time>
            @elseif($job->type->type == 'Contract')
                <contract>1</contract>
            @elseif($job->type->type == 'Temporary')
                <temporary>1</temporary>
            @endif
        </description>
        <compensation>
            <salary-range><![CDATA[{{ $job->salary }}]]</salary-range>
        </compensation>
        <posted-date>{{ $job->created_at->format('Y/m/d') }}</posted-date>
        <close-date>{{ $job->expire->format('Y/m/d') }}</close-date>
        <location>
            <city>{{ $job->company_city }}</city>
            <state>{{ $job->state->title }}</state>
            <country>US</country>
        </location>
        <company>
            @if($job->confidential)
                <name>Confidential</name>
            @else
                <name><![CDATA[{{ $job->company_name }}]]</name>
            @endif
            <industry><![CDATA[{{ $job->categories->first()->title }}]]</industry>
        </company>
    </job>
    @endforeach
</jobs>
