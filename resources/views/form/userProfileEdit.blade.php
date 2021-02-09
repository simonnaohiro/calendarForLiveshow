@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ __('ユーザーページを編集する') }}</div>
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
                        <label for="introduction" class="col-md-4 col-form-label text-md-right">{{ __('自己紹介') }}</label>
                        <div class="col-md-6">
                            <textarea id="introduction" class="event-text @error('introduction') is-invalid @enderror" name="introduction" >{{old('introduction')}}</textarea>
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