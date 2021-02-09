@extends('layouts.app')

@section('content')
    <div class="prev-next-wrapper">

        <a class="prev" href="{{route('events_list', ['year' => $yesterday->year, 'month' => $yesterday->month, 'day' => $yesterday->day ])}}">
            {{ $yesterday->year}}&#047;{{$yesterday->month}}&#047;{{$yesterday->day}}&lt;
        </a>
        <h3 class="month-header">{{$today->month}}月{{$today->day}}日</h3>
        <a class="next" href="{{route('events_list',['year' => $tomorrow->year, 'month' => $tomorrow->month, 'day' => $tomorrow->day ])}}">
            &gt;{{$tomorrow->year}}&#047;{{$tomorrow->month}}&#047;{{$tomorrow->day}}
        </a>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header">イベント一覧</div>
            <div class="card-body">
                <ul>
                    @foreach ($todayEvents as $event)
                    <div class="row">
                        <div class="p-2">
                            <li>
                                <a class="events-list overwrap-link" href="{{route('event', ['event_id' => $event->id])}}">
                                    {{$event->event_title}}
                                </a>
                            </li>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </ul>
                @if (!isset($event))
                    <h3>本日のイベントは登録されていません。</h3>
                @endif
                <button class="btn btn-primary m-3"><a href="{{route('calendar', ['year' => $today->year, 'month' => $today->month])}}">カレンダーに戻る</a></button>
            </div>
        </div>
    </div>
@endsection