@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <form class="" method="POST" >
                @csrf
                <div class="card-body">
                    <div class="col-md-3">
                        リクエストがありません。
                    </div>
                </div>

                <button class="btn btn-primary"><a href="{{route('home')}}">トップページへ</a></button>
            </form>
        </div>
    </div>
@endsection