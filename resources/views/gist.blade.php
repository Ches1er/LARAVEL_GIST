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

@section("title","Main")
@section("content")
    <nav>@yield("menu")</nav>
    <section>
        <div class="show_gist_container">
            <a class="back" href="{{route('main')}}">Main Page</a>
            <div class="gist_name">{{$gist->name}}</div>
            <hr />
            <div class="gist_desc">Gist Description: {!! $gist->desc !!}</div>
            <hr />
            <table>
                @forelse($files as $file)
                    <caption>Gist contents next files:</caption>
                    <tr>
                        <td><a class="gist_file" href="/showfile/{{$file->id}}">{{$file->name}}</a></td>
                    </tr>
                @empty
                    <caption>Gist doesnt have any files yet:</caption>
                @endforelse
            </table>
        </div>
    </section>
@endsection





