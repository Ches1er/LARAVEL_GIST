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

@section("title","Mygists")

@section("content")
    <nav>@yield("menu")</nav>
    @guest
        <div class="current_user">Current user: none</div>
    @else
        <div class="current_user">Current user :{{Auth::user()->name}}</div>
    @endguest
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
        <h3>My gists list:</h3>
        @foreach($gists as $gist)
            <div class="full_info_container">
                <div class="gist_container">
                    <a class="gist_name" href="{{route("showmygist",["gistid"=>$gist->id])}}">{{$gist->name}}</a>
                    <form action="mygists/delgist/{{$gist->id}}" method="post">
                        @method("delete")
                        @csrf
                        <input type="submit" value="Delete gist">
                    </form>
                    @forelse($files_count as $file_count)
                        @if($file_count->gist_id===$gist->id)
                            <div class="file_count">Number of files: {{$file_count->count}}</div>
                        @endif
                    @empty
                    @endforelse
                </div>
                {{$gists->links()}}
            </div>
        @endforeach
    </div>
    </section>
@endsection
