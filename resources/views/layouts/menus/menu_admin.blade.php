@section("menu")

    <ul class="main_menu">
        <li><a href="{{route("main")}}">Main</a></li>
        <li><a href="{{route("profile")}}">Profile</a></li>
        <li><a href="{{route("mygists")}}">MyGists</a></li>
        <li><a href="{{route("admin")}}">Admin</a></li>
        <li><a href="{{route("file_exchange")}}">FileExch</a></li>
        <li><a href="{{route("_logout")}}">Logout</a></li>
    </ul>

@endsection
