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
            @foreach($user_categories as $user_category)
                <li><a href="{{route("mygists_categories",['caturl'=>$user_category->name])}}">{{$user_category->name}}</a></li>
            @endforeach
        </ul>

    </aside>

    <div class="main_content">
        <div class="add_new">
            <h3>Add new gist</h3>
            @if(session('message'))
                <div class="message">{{session('message')}}</div>
            @endif
            <form action="{{route("addgist")}}" method="post">
                @csrf
                Pick category:<select name="category_name" id="">
                    @foreach ($all_categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                Or create new:<input type="text" name="category_name_new" placeholder="New category name..." value="{{old('category_name_new')}}">
                Add gist name:<input type="text" name="gist_name" placeholder="Gist name..." value="{{old('gist_name')}}">
                @if($errors->has('name'))
                    <span class="validation_error">{{$errors->first('name')}}</span>
                    @endif
                Add gist description:<textarea name="gist_desc"></textarea>
                @if($errors->has('desc'))
                    <span class="validation_error">{{$errors->first('desc')}}</span>
                @endif
                Make private:<input type="checkbox" name="private">
                <input type="submit" value="Add">
            </form>
        </div>
        <hr />
        <h3>My gists list:</h3>
        @forelse($gists as $gist)
            <div class="full_info_container">
                <div class="gist_container">
                    <a class="gist_name" href="{{route("showmygist",["gistid"=>$gist->id])}}">{{$gist->name}}</a>
                    @if($gist->private==='private')<span class="private_gist">Private gist</span>@endif
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

            </div>

        @empty
            <p class="files">You dont have any gists yet:</p>
        @endforelse
        {{$gists->links()}}
    </div>
    </section>
@endsection
