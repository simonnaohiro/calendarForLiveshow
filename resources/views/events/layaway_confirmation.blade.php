@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <form class="" method="POST" >
                @csrf
                <div class="card-body">
                    <div class="col-md-5">
                        <h3>{{ $performer }}</h3>のチケットを取り置きますか？
                    </div>
                </div>
                <button class="btn btn-primary m-3" type="submit">チケットを取り置く</button>
            </form>
        </div>
    </div>
@endsection