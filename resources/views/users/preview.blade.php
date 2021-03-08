@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>プレビュー画面です</h2>
        <div class="card">
            <div class="card-header">
                {{$user_name}}さんのプロフィール
            </div>
            <div class="card-body">
                {{-- @if (!blank($profile['image_icon']))
                    <hr>
                    {{$profile['image_icon']}}
                @else
                    アイコンは未設定です
                @endif
                <hr> --}}
                <div class="event-group row">
                    <label class="label-w-1">{{__('名前')}}</label>
                    <div class="col-md-8">
                    @if (isset($profile))
                        {{$profile['user_name']}}
                    @else
                        名前は未設定です。
                    @endif
                    </div>
                </div>
                <div class="event-group row">
                    <label class="label-w-1">{{__('自己紹介')}}</label>
                    <div class="col-md-8">
                    @if (isset($profile))
                        {{$profile['introduction']}}
                    @else
                        自己紹介は未設定です。
                    @endif
                    </div>
                </div>
                <hr>
            </div>
            <form method="POST" action="{{route('save_profile')}}">
                @csrf
                <input type="hidden" name="image_icon" value="{{$profile['image_icon']}}" readonly>
                <input type="hidden" name="user_name" value="{{$profile['user_name']}}" readonly>
                <input type="hidden" name="introduction" value="{{$profile['introduction']}}" readonly>
                <button class="btn btn-primary m-3" type="submit">投稿する</button>
            </form>
            </div>
        </div>
    </div>
@endsection