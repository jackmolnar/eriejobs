{{ '<?xml version="1.0" encoding="utf-8"?>'  }}
<source>
    <publisher>EriePaJobs</publisher>
    <publisherurl>https://eriepajobs.com</publisherurl>
    @foreach($jobs as $job)
        <job>
            <title><![CDATA[ {{$job->title}} ]]></title>
            <date><![CDATA[ {{ $job->created_at->format('D, d M Y H:i:s e') }}]]></date>
            <referencenumber><![CDATA[ {{$job->id}} ]]></referencenumber>
            <url><![CDATA[ {{ action('JobsController@show', $job->slug)  }}]]></url>
            @if($job->confidential)
                <company><![CDATA[Confidential]]></company>
            @else
                <company><![CDATA[ {{ $job->company_name }} ]]></company>
            @endif
            <city><![CDATA[ {{ $job->company_city }} ]]></city>
            <state><![CDATA[ {{ $job->state->title }} ]]></state>
            <country><![CDATA[US]]></country>
            <description><![CDATA[ {{ $job->description }} ]]></description>
            <salary><![CDATA[ {{ $job->salary }} ]]></salary>
            <category><![CDATA[ {{ $job->categories->first()->category }}]]></category>
        </job>
    @endforeach
</source>