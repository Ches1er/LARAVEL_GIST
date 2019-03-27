@extends("layouts.default")

@section("title","Mygists")

@section("content")

    <h3>MyGists</h3>

    @foreach($gists as $gist)

    <p>{{$gist_name}}</p>
    <p>{{$file_name}}</p>

    @endforeach


@endsection