@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
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
                        {{$profile->introduction}}
                    @else
                        自己紹介は未設定です。
                    @endif
                    </div>
                </div>
                <hr>
                <div class="btn-wrapper">
                    <button class="btn btn-primary"><a href="{{route('edit_profile')}}">プロフィールを編集する</a></button>
                </div>
            </div>
        </div>
    </div>
@endsection