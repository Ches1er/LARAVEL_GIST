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

        <aside>
            <ul class="category_menu">
                <li><a href="/showcat/all">All</a></li>
                @foreach($categories as $category)
                    <li><a href="{{route("showcat",['caturl'=>$category])}}"><?=$category?></a></li>
                @endforeach
            </ul>
        </aside>

        <div class="main_content">
            @foreach($gists as $gist)
                <div class="full_info_container">
                    <div class="gist_container">
                        <a class="gist_name" href="{{route("showgist",["gistid"=>$gist["id"]])}}"><?=$gist["gist_name"]?></a>
                        <div class="gist_author"><?=$gist["gist_author"]?></div>
                        <div class="gist_date"><?=$gist["gist_date"]?></div>
                        <div class="gist_desc"><?=$gist["gist_desc"]?></div>
                        <!--<div class="gist_files">
                            @foreach($gist["files"] as $file)
                                <div class="gist_file"><?=$file?></div>
                            @endforeach
                        </div> -->
                    </div>
                    <div class="upic"><img class="large_avatar" src="/aaa" alt=""></div>
                </div>
            @endforeach
        </div>

    </section>
@endsection
