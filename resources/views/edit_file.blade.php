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

@section("content")
    <nav>@yield("menu")</nav>
    <section>
        <div class="edit_container">
            <form action="">
                <textarea name="edit_file">{{$file->content}}</textarea>
                <input type="submit" value="Edit">
            </form>

        </div>
    </section>
@endsection





