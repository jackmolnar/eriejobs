@extends('layouts.default')

@section('content')

    <div class="container reader_dates">

        <div class="col-md-8">

            <h1>Erie Reader Publish Dates</h1>

            <hr/>

            <p>
                Approximately 12,000 copies of the Erie Reader are printed and distributed in 275 high traffic locations and is published every other Wednesday.
            </p>
            <p>
                Below are the upcoming scheduled publish dates:
            </p>

            <ul>
                @foreach($readerDates as $readerDate)
                    <li>{{ $readerDate->pub_date->toFormattedDateString() }}</li>
                @endforeach
            </ul>
        </div>
    </div>

@stop
