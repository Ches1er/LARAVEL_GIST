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

@section("content")
    <nav>@yield("menu")</nav>
    <section>
        <div class="show_gist_container">
            <a class="back" href="{{route('mygists')}}">Back to Mygists</a>
            <div class="gist_name">{{$gist->name}}</div>
            <hr />
            <div class="gist_desc">Gist Description: {!! $gist->desc !!}</div>
            <hr />
            <ul>
                @forelse($files as $file)
                    <p class="files">Gist contents next files:</p>
                    <li><a class="gist_file" href="files/showfile/{{$file->id}}">{{$file->name}}</a>
                    <form action="files/delfile/{{$file->id}}" method="post">
                        @method("delete")
                        @csrf
                        <input type="submit" value="Delete file">
                    </form>
                    </li>
                @empty
                    <p class="files">Gist doesnt have any files yet:</p>
                @endforelse
            </ul>
            <div class="add_new">
                <p class="add_new_p">Add new file</p>
                <form action="files/addfile" method="post">
                    @csrf
                    <input type="hidden" name="gist_id" value="{{$gist->id}}">
                    Add file name:<input type="text" name="file_name">
                    Add file content:<textarea name="file_content"></textarea>
                    <input type="submit" value="Add">
                </form>
            </div>
        </div>
    </section>
@endsection




