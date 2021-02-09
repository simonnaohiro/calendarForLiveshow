@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                取り置き済み名前一覧
            </div>
            <div class="card-body">
                <table>
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