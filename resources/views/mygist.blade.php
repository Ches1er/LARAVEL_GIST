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
        <div class="show_gist_container">
            <div class="gist_name">{{$gist->name}}</div>
            <hr />
            <div class="gist_desc">{{$gist->desc}}</div>
            @forelse($files as $file)
                <a class="gist_file" href="files/showfile/{{$file->id}}">{{$file->name}}</a>
                <form action="files/delfile/{{$file->id}}" method="post">
                    @method("delete")
                    @csrf
                    <input type="submit" value="Delete file">
                </form>
            @empty
                <p>empty</p>
            @endforelse

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




