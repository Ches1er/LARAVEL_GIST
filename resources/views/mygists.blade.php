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

@section("title","Mygists")

@section("content")
    <nav>@yield("menu")</nav>
    <h3>MyGists</h3>
    <section>
    <aside>
        <ul class="category_menu">
            <li><a href="{{route("mygists_categories",['caturl'=>"all"])}}">All</a></li>
            @foreach($categories as $category)
                <li><a href="{{route("mygists_categories",['caturl'=>$category->name])}}">{{$category->name}}</a></li>
            @endforeach
        </ul>

    </aside>

    <div class="main_content">
        <div class="add_new">
            <p class="add_new_p">Add new gist</p>
            <form action="{{route("addgist")}}" method="post">
                @csrf
                Pick category:<select name="category_name" id="">
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                Add gist name:<input type="text" name="gist_name">
                Add gist desc:<textarea name="gist_desc"></textarea>
                <input type="submit" value="Add">
            </form>
        </div>
        <hr />
        @foreach($gists as $gist)
            <div class="full_info_container">
                <div class="gist_container">
                    <a class="gist_name" href="{{route("showmygist",["gistid"=>$gist->id])}}">{{$gist->name}}</a>
                    <form action="mygists/delgist/{{$gist->id}}" method="post">
                        @method("delete")
                        @csrf
                        <input type="submit" value="Delete gist">
                    </form>
                </div>
                <div class="upic"><img class="large_avatar" src="/aaa" alt=""></div>
            </div>
        @endforeach
    </div>
    </section>
@endsection
