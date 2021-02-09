@extends('layouts.app')

@section('content')
    <a href="/upload">画像のアップロードに戻る</a>
    <br>
    @foreach ($user_images as $user_image)
        <img src="{{ $user_image['path'] }}">
        <br>
    @endforeach
@endsection