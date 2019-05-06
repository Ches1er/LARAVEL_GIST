@extends('layouts.default')

@section('content')
    <div class="login_success">
        <div class="greetings">
            Hello {{ Auth::user()->name }}. Congrats, your email has been verified. Now you can use MyGists.
        </div>
        <div class="back_main">
            <a href="{{ route('main') }}">Back to Main page</a>
        </div>
    </div>
@endsection
