@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>プレビュー画面です</h2>
        <div class="card">
            <div class="card-header">
                {{$event['event_title']}}
            </div>
            <div class="card-body">
                {{$poster->name}}
                <hr>
                {!! nl2br(e($event['price'])) !!}
                <hr>
                {{$event['event_date']}}
                @if (!blank($event['event_image']))
                    <hr>
                    {{$event['event_image']}}
                @endif
                <hr>
                {!! nl2br(e($event['contents'])) !!}
                <hr>
                {{$event['performers']}}
                <hr>

            <form method="POST">
                @csrf
                <input type="hidden" name="event_title" value="{{$event['event_title']}}" readonly>
                <input type="hidden" name="price" value="{{$event['price']}}" readonly>
                <input type="hidden" name="event_date" value="{{$event['event_date']}}" readonly>
                <input type="hidden" name="event_image" value="{{$event['event_image']}}" readonly>
                <input type="hidden" name="contents" value="{{$event['contents']}}" readonly>
                <input type="hidden" name="performers" value="{{$event['performers']}}" readonly>
                <input type="hidden" name="post_user_id" value="{{$event['post_user_id']}}" readonly>
                <button class="btn btn-primary m-3" type="submit">投稿する</button>
            </form>
            </div>
        </div>
    </div>
@endsection