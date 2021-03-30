@extends('layouts.app')

@section('add head')
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
@endsection

@section('content')
    <div class="container">
        @if ($ended_at)
            <h1 class="head-primary">こちらのイベントは終了いたしました。</h1>
        @endif
        <div class="card">
            <div class="card-header event_header">
                <h3>Title:<b>{{$event->event_title}}</b></h3>
            @if (!blank($same_user))
                <a href=" {{route('event_edit', ['event_id' => $event_id]) }} ">編集</a>
            @endif
            </div>
            <div class="card-body">
                <div class="event-group row">
                    <label class="label-w-1">{{__('投稿者')}}</label>
                    <div class="col-md-6"><h5>{{$poster->name}}</h5>
                        <a href="{{route('show_profile', ['user_id' => $poster->id])}}">投稿者のプロフィールへ</a>
                    </div>
                </div>
                <hr>
                <div class="event-group row">
                    <label class="label-w-1">{{__('料金')}}</label>
                    <div class="col-md-6">
                        <p>¥
                        @if (!blank($event->price))
                            {{$event->price}}
                        @else
                            0
                        @endif
                        </p>
                    </div>
                </div>
                <hr>
                <div class="event-group row">
                    <label class="label-w-1">{{__('開始日時')}}</label>
                    <div class="col-md-6">
                        {{$event->event_date}}
                    </div>
                    <hr>
                </div>
                <hr>

                @if (!blank($event->event_image))
                <div class="event-group row">
                    <label class="label-w-1">{{__('イメージ')}}</label>
                    <div class="col-md-6">
                        {{$event->event_image}}
                    </div>
                </div>
                <hr>
                @endif

                <div class="event-group row">
                    <label class="label-w-1">{{__('イベント内容')}}</label>
                    <div class="col-md-6">
                        {!! nl2br(e($event->contents)) !!}
                    </div>
                </div>
                <hr>

                <div class="event-group row">
                    <label class="label-w-1">{{__('出演者一覧')}}</label>
                    <div class="col-md-6">
                        @foreach ($performers as $key => $performer)
                        <div>
                            @if ($ended_at)
                                <p class="deleted">{{$performer}}</p>
                            @else
                                <a href="{{route('redirect_ticket_on_layaway', ['event_id' => $event->id, 'performer' => $performer])}} ">{{$performer}}</a>
                            @endif
                        </div>
                        @endforeach
                        @if (!blank($same_user))
                        <button class="btb btn-primary"><a href="{{route('performers_list', ['event_id' => $event->id])}}">出演者リスト</a></button>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="btn-wrapper">
                    <button class="btn btn-primary m-3"><a href="{{route('event_list', ['year' => $ymdt[0], 'month' => $ymdt[1], 'day' => $ymdt[2],])}}">リストに戻る</a></button>
                @if (!blank($same_user) && !$ended_at)
                    <button class="btn btn-secondary m-3"><a href="{{route('finish_event', [$event_id, $poster->id])}}">イベントを終了する</a></button>
                @endif
                </div>
            </div>
        </div>
        <div class="outside-wrapper">
        @if (!blank($same_user))
            <a href=" {{route('soft_delete', ['event_id' => $event_id, 'poster_id' => $poster->id])}} ">投稿を削除</a>
        @endif
        
        <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" data-text="こんにちは！お友達のイベントを見に行ってみませんか！きっと新しい推しバンドが見つかるかも？" data-hashtags='ライブカレンダー' class="twitter-share-button" data-show-count="false">Tweet</a>
        </div>
    </div>
@endsection