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
            <company><![CDATA[ {{ $job->company_name }} ]]></company>
            <city><![CDATA[ {{ $job->city }} ]]></city>
            <state><![CDATA[ {{ $job->state->title }} ]]></state>
            <country><![CDATA[US]]></country>
            <description><![CDATA[ {{ strip_tags($job->description) }} ]]></description>
            <salary><![CDATA[ {{ $job->salary }} ]]></salary>
            <jobtype><![CDATA[ {{ $job->type->type }} ]]></jobtype>
            <category><![CDATA[ {{ $job->categories->first()->category }}]]></category>
        </job>
    @endforeach
</source>