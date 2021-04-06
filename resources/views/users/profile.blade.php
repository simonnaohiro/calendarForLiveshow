@extends('layouts.app')

@section('content')
    <div class="container profile">
        @component('components.side_bar')
            @slot('content')
            <h5>投稿したイベント</h5>
                @foreach ($posted_events as $event)
                    <li><a href="{{route('event', ['event_id' => $event->id])}}">{{$event->event_title}}</a></li>
                @endforeach
            @endslot
        @endcomponent
        <div class="card profile-body ">
            <div class="card-header">
                {{$profile->user->name}}さんのプロフィール
            </div>
            <div class="card-body">
                {{-- <div class="event-group row">
                    <label class="label-w-1">{{__('アイコン')}}</label>
                    <div class="col-md-6">
                    @if (isset($profile->image_icon))
                        {{$profile->image_icon}}
                    @else
                        アイコンは未設定です
                    @endif
                    </div>
                </div>
                <hr> --}}
                <div class="event-group row">
                    <label class="label-w-1">{{__('自己紹介')}}</label>
                    <div class="col-md-8">
                    @if (isset($profile))
                        {!! nl2br($profile->introduction) !!}
                    @else
                        自己紹介は未設定です。
                    @endif
                    </div>
                </div>
                <hr>
                <div class="event-group row">
                    <div class="posted-event-list">
                        <div class="p-2">
                            <h5>投稿したイベント(10件)</h5>
                            @foreach ($posted_events as $event)
                                <li><a href="{{route('event', ['event_id' => $event->id])}}">{{$event->event_title}}</a></li>
                            @endforeach
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="btn-wrapper">
                    <button class="btn btn-primary"><a href="{{route('edit_profile')}}">プロフィールを編集する</a></button>
                </div>
            </div>
        </div>
    </div>
@endsection