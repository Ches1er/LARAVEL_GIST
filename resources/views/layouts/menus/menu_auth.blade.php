@section("menu")

    <ul class="main_menu">
        <li><a href="{{route("main")}}">Main</a></li>
        <li><a href="{{route("profile")}}">Profile</a></li>
        <li><a href="{{route("mygists")}}">MyGists</a></li>
        <li><a href="{{ route('logout') }}">Logout</a></li>
    </ul>

@endsection
