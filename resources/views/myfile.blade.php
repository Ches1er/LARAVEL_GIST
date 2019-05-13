@extends("layouts.default")

@guest
    @include("layouts.menus.menu_guest")
@else
    @if(!is_null($user_roles))
        @foreach($user_roles as $role)
            @if($role === "Admin")
                @include("layouts.menus.menu_admin")
                @break
            @else
                @include("layouts.menus.menu_auth")
            @endif
        @endforeach
    @endif
    @include("layouts.menus.menu_nonauth")
@endguest

@section("title","File")
@section("content")
    <nav>@yield("menu")</nav>
    <section>
        <div class="show_gist_container">
            <div class="buttons">
                <a class="back" href="{{route('showmygist',['gist_id'=>$file->gist_id])}}">Back to the gist</a>
            </div>

            <div class="gist_name">{{$file->name}}</div>
            <div class="gist_desc">{!! $file->content !!}</div>
        </div>

    </section>
@endsection
