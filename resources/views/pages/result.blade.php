@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <form class="" method="POST" >
                @csrf
                <div class="card-body">
                    <div class="col-md-6">
                        {{ $message }}
                    </div>
                </div>
                @if (!blank($redirect_page))
                    <input type="hidden" name="redirect_page" value="{{$redirect_page}}" readonly>
                @endif
                <button class="btn btn-primary m-3" type="submit">{{$button}}</button>
            </form>
        </div>
    </div>
@endsection