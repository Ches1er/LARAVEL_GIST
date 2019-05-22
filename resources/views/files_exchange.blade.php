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
            <form action="{{route('file_exchange_handle')}}" method='POST' enctype="multipart/form-data">
                @csrf
                <input type="file" name="file">
                Make private:<input type="checkbox" name="private">
                <input type="submit" value="Add file">
            </form>
            @if(!empty($files_exch))
            @foreach($files_exch as $file_exch)
                @if($file_exch->private==='private' && $file_exch->user_id===$user_id)
                        {{$file_exch->name}}
                        <form action="/upload_file" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$file_exch->id}}">
                            <input type="submit" value="Upload">
                        </form>
                    @continue
                    @elseif($file_exch->private==='public')
                        {{$file_exch->name}}
                        <form action="{{route('file_exchange_download')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$file_exch->id}}" name="id">
                            <input type="submit" value="Download">
                        </form>
                    @endif

                @endforeach
                @endif
        </div>
    </section>
@endsection

