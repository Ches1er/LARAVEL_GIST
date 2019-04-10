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
            <div class="gist_name">{{$gist->name}}</div>
            <div class="gist_desc">{!! $gist->desc !!}</div>
            @forelse($files as $file)
                <a class="gist_file" href="/showfile/{{$file->id}}">{{$file->name}}</a>
                @empty
                <a class="gist_author">No files yet here</a>
                @endforelse
        </div>
    </section>
@endsection



