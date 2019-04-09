@extends('layouts.default')

@section('content')
    <div class="login_success">
        <div class="greetings">
            You are logged in as: {{ Auth::user()->name }}
        </div>
        <div class="back_main">
            <a href="{{ route('main') }}">Back to Main page</a>
        </div>
        @if (session('status'))
            <span class="login_register_error">
            {{ session('status') }}
        </span>
        @endif
    </div>
@endsection
