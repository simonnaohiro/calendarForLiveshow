@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ __('ユーザーページを'.$edit_or_create.'する') }}</div>
            <div class="card-body">
                <form method="POST" action="{{route('register_profile')}}">
                    @csrf
                    {{-- <div class="form-group row">
                        <label for="image_icon" class="col-md-4 col-form-label text-md-right">{{ __('ユーザーアイコン') }}</label>
                        <div class="col-md-6"> --}}
                            <input id="image_icon" class="@error('event_title') is-invalid @enderror" type="hidden" name="image_icon" value="{{old('image_icon')}}">
                            {{-- @error('image_icon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('名前') }}</label>
                        <div class="col-md-6">
                            <input id="user_name" class="@error('name') is-invalid @enderror" name="user_name" value="{{ !blank($profile) ? $profile->user->name : $user_name}}">
                            @error('user_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="introduction" class="col-md-4 col-form-label text-md-right">{{ __('自己紹介') }}</label>
                        <div class="col-md-6">
                            <textarea id="introduction" class="event-text @error('introduction') is-invalid @enderror" name="introduction" >{{!blank($profile) ? $profile->introduction : old('introduction')}}</textarea>
                            @error('introduction')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('プロフィール登録') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
@endsection