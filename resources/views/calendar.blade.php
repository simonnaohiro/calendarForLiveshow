@extends('layouts.app')
@section('content')
<div class="calendar-p">
  <div class="prev-next-wrapper">
    <a class="prev" href="{{route('calendar',['year' => $lastMonth->year, 'month' => $lastMonth->month])}}">{{ $lastMonth->year}}&#047;{{$lastMonth->month}}&lt;</a>
    <h3 class="month-header">{{$currentMonth->month}}月</h3>
    <a class="next" href="{{route('calendar',['year' => $nextMonth->year, 'month' => $nextMonth->month])}}">&gt;{{ $nextMonth->year}}&#047;{{$nextMonth->month }}</a>
  </div>
  <table class="table table-bordered radius">
    <thead>
      <tr>
      @foreach (['日', '月', '火', '水', '木', '金', '土'] as $dayOfWeek)
        @if ($dayOfWeek === '土')
          <th class="saturday">{{ $dayOfWeek }}</th>
        @elseif ($dayOfWeek === '日')
          <th class="sunday">{{ $dayOfWeek }}</th>
        @else
          <th>{{ $dayOfWeek }}</th>
        @endif
  
      @endforeach
      </tr>
    </thead>
    <tbody>
    @foreach ($dates as $date)
  
    @if ($date->dayOfWeek == 0)
      <tr>  
    @endif
        {{-- それぞれ、今月の以外の日付専用の、現在日、土曜日曜のスタイルの処理 （ChromeのDevToolで見えづらくなってしまったため、一行でまとめる）--}}
        <td class="day {{ $date->month != $currentMonth->month ? 'bg-secondary' : '' }}">
          <a href="{{route('event_list', ['year' => $date->year, 'month' => $date->month, 'day' => $date->day])}}" class="day-link {{$date->day == $currentDay->day && $currentMonth->month == $currentDay->month ? 'today' : ''}} @if ($date->day == $currentDay->day && $currentMonth->month == $currentDay->month) '' @elseif ($date->dayOfWeek == 0) sunday @elseif ($date->dayOfWeek == 6) saturday @endif">{{$date->day}}</a>
        </td>
    @if ($date->dayOfWeek == 6)
      </tr>
    @endif
  @endforeach
  </tbody>
  </table>
</div>
@endsection