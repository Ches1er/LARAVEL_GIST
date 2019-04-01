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
            <div class="gist_name">Name</div>
            <hr />
            <div class="add_new_file">
                <p class="add_new_p">Add new file</p>
                <form action="{{route("addfile")}}" method="post">
                    @csrf
                    <!--<input type="hidden" name="gist_id" value="<?=$gist_id?>">-->
                    Add file name:<input type="text" name="file_name">
                    Add file content:<textarea name="file_content"></textarea>
                    <input type="submit" value="Add">
                </form>
            </div>
            <div class="gist_date">Date</div>
            <div class="gist_desc">Desc</div>
            @foreach($files as $file)
                <div class="gist_file"><?=$file?></div>
                <a class="gist_file_edit" href="/file_id?>">edit</a>
                <a class="gist_file_del" href="/file_id?>">del</a>
            @endforeach
        </div>
    </section>
@endsection




