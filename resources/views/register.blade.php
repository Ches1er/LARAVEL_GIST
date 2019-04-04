@extends("layouts.default")
@section("title","Main")
@section("content")
    <section>
        <form action="/registerhandle" method="post">
            @csrf
            Name:<input type="text" name="name">
            Password:<input type="password" name="password">
            Email:<input type="text" name="email">
            <input type="submit">
        </form>
    </section>
@endsection()
