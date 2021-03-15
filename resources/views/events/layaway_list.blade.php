@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>{{$performer}}取り置き済み名前一覧</h3>
            </div>
            <div class="card-body">
                <table>
                    <button class="btn btn-primary"><a href="{{route('pdf', ['event_id' => $event_id, 'performer' => $performer, 'poster_id' => $poster_id])}}">PDF化する</a></button>
                @foreach ($layaway_users as $layaway_user)
                    <div>
                        {{$layaway_user->name}}
                    </div>
                @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection