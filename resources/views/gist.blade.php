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

@section("title","Main")
@section("content")
    <nav>@yield("menu")</nav>
    <section>
        <div class="show_gist_container">
            <div class="gist_name">Name</div>
            <div class="gist_date">Date</div>
            <div class="gist_desc">Desc</div>
        @foreach($files as $file)
            <div class="gist_file"><?= $file?></div>
        @endforeach
        </div>
    </section>
@endsection



