{{ '<?xml version="1.0" encoding="utf-8"?>'  }}
@foreach($jobs as $job)
    <job>
        <date><![CDATA[ {{ $job->created_at->format('D, d M Y H:i:s e') }}]]></date>
        <referencenumber><![CDATA[ {{$job->id}} ]]></referencenumber>
        <url><![CDATA[ {{ action('JobsController@show', $job->slug)  }}]]></url>
        <company><![CDATA[ {{ $job->company_name }} ]]></company>
        <state><![CDATA[ {{ $job->state->title }} ]]></state>
        <country><![CDATA[US]]></country>
        <description><![CDATA[ {{ $job->description }} ]]></description>
    </job>
@endforeach


<jobs>
    @foreach($jobs as $job)
    <job>
        <title>$job->title</title>
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
        <job-category>{{ $job->categories->first()->title }}</job-category>
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
            <salary-range>{{ $job->salary }}</salary-range>
        </compensation>
        <!-- date in Unix format: yyyy/MM/dd  -->
        <posted-date>{{ $job->created_at->format('Y/m/d') }}</posted-date>
        <close-date>{{ $job->expire->format('Y/m/d') }}</close-date>
        <location>
            <city>{{ $job->city }}</city>
            <state>{{ $job->state->title }}</state>
            <country>US</country>
        </location>
        <company>
            @if($job->confidential)
                <name>Confidential</name>
            @else
                <name>{{ $job->company_name }}</name>
            @endif
            <description>
                <![CDATA[
                We run a virtual environment. As a result, some of our employers work remotely.
                ]]>
            </description>
            <industry>Manufacturing</industry>
            <url>http://www.samplejobboardurl.com</url>
        </company>
    </job>
    @endforeach
</jobs>



@foreach($jobs as $job)
<job>
    <title><![CDATA[ {{$job->title}} ]]></title>
    <date><![CDATA[ {{ $job->created_at->format('D, d M Y H:i:s e') }}]]></date>
    <referencenumber><![CDATA[ {{$job->id}} ]]></referencenumber>
    <url><![CDATA[ {{ action('JobsController@show', $job->slug)  }}]]></url>
    <company><![CDATA[ {{ $job->company_name }} ]]></company>
    <city><![CDATA[ {{ $job->city }} ]]></city>
    <state><![CDATA[ {{ $job->state->title }} ]]></state>
    <country><![CDATA[US]]></country>
    <description><![CDATA[ {{ $job->description }} ]]></description>
    <salary><![CDATA[ {{ $job->salary }} ]]></salary>
    <jobtype><![CDATA[ {{ $job->type->type }} ]]></jobtype>
    <category><![CDATA[ {{ $job->categories->first()->title }}]]></category>
</job>
@endforeach
