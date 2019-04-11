@extends("layouts.default")
@if(!empty($user_roles))
    @if(in_array("admin", $user_roles))@include("layouts.menus.menu_admin")
    @elseif(in_array("user", $user_roles))@include("layouts.menus.menu_auth")
    @endif
@endif
@if(is_null($user))@include("layouts.menus.menu_guest")
@endif
@if(!is_null($user)&& empty($user_roles))@include("layouts.menus.menu_nonauth")
@endif
@if(is_null($user))@include("layouts.menus.menu_guest")
@endif

@section("title","File")
@section("content")
    <nav>@yield("menu")</nav>
    <section>
        <div class="show_gist_container">
            <div class="buttons">
                <a class="back" href="/mygists/{{$file->gist_id}}">Back to the gist</a>
            </div>

            <div class="gist_name">{{$file->name}}</div>
            <div class="gist_desc">{!! $file->content !!}</div>
        </div>

    </section>
@endsection
