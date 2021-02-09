@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                出演者一覧
            </div>
            <div class="card-body">
                @foreach ($performers as $performer)
                    <div>
                        <a href="{{route('layaway_list', ['event_id' => $event_id, 'performer' => $performer])}}">{{$performer}}</a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="outside-wrapper">
        </div>
    </div>
@endsection