@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">{{ __('イベント情報編集') }}</div>
        <div class="card-body">
            <form method="POST" action="{{route('register_edit_event' ,['event_id' => $event_id])}}">
                @csrf
                <div class="form-group row">
                    <label for="event_date" class="col-md-4 col-form-label text-md-right">{{ __('イベントの日時') }}</label>
                    <div class="col-md-6">
                        <input id="event_date" type="datetime-local" name="event_date" class="@error('event_date') is-invalid @enderror" value="{{!blank(old('event_date')) ? old('event_date') : $event_date}}">
                        @error('event_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="event_title" class="col-md-4 col-form-label text-md-right">{{ __('イベントタイトル') }}</label>
                    <div class="col-md-6">
                        <input id="event_title" class="@error('event_title') is-invalid @enderror" type="text" name="event_title" value="{{!blank(old('event_title')) ? old('event_title') : $event->event_title}}">
                        @error('event_title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('料金') }}</label>
                    <div class="col-md-6">
                        <input id="price" class="@error('price') is-invalid @enderror" type="text" name="price" value="{{ !blank(old('price')) ? old('price') : $event->price }}">
                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="contents" class="col-md-4 col-form-label text-md-right">{{ __('イベント内容') }}</label>
                    <div class="col-md-6">
                        <textarea id="contents" class="event-text @error('contents') is-invalid @enderror" name="contents" >{{ !blank(old('contents')) ? old('contents') : $event->contents}}</textarea>
                        @error('contents')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="performers" class="col-md-4 col-form-label text-md-right">{{ __('出演者一覧') }}</label>
                    <div class="col-md-6">
                        <textarea id="performers" class="event-text @error('performers') is-invalid @enderror" type="text" name="performers" placeholder="出演者名を改行、空白、または/で区切ってください。また出演者名に空白が入る場合は_(アンダーバー)などで代替してください">{{ !blank(old('performers')) ? old('performers') : $event->performers}}</textarea>
                        @error('performers')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <input id="event_id" type="hidden" name="event_id" value="{{ $event_id }}" readonly/> 
                @error('event_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('変更を登録') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>
@endsection