@extends("layouts.default")

@guest
    @include("layouts.menus.menu_guest")
    @else
    @if(!empty($user_roles))
        @foreach($user_roles as $role)
            @if($role->name === "Admin")
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
    @guest
        <div class="current_user">Current user: none</div>
        @else
        <div class="current_user">Current user :{{Auth::user()->name}}</div>
    @endguest
    <section>
        <aside>
            <ul class="category_menu">
                <li><a href="/showcat/all">All</a></li>
                @foreach($categories as $category)
                    <li><a href="{{route("showcat",['caturl'=>$category->name])}}">{{$category->name}}</a></li>
                @endforeach
            </ul>
        </aside>

        <div class="main_content">
            <div class="about_resource">About</div>
            <div class="gists">
            @forelse($gists as $gist)
                <div class="full_info_container">
                    <div class="gist_container">
                        <a class="gist_name" href="{{route("showgist",["gistid"=>$gist->id])}}">{{$gist->name}}</a>
                        <div class="gist_author">Author:</div>
                        <div class="gist_date"><?=date('d-m-y h:m:s',$gist->date)?></div>
                        <div class="gist_desc">{{$gist->desc}}</div>
                        @forelse($files_count as $file_count)
                            @if($file_count->gist_id===$gist->id)
                                <div class="file_count">Number of files: {{$file_count->count}}</div>
                            @endif
                            @empty
                            @endforelse
                    </div>
                    <div class="upic"><img class="large_avatar" src="/aaa" alt=""></div>
                </div>
                 @empty
                    <div class="full_info_container">
                        <div class="gist_container">
                            <div class="gist_author">Empty gists list</div>
                        </div>
                    </div>
            @endforelse
            </div>
        </div>

    </section>
@endsection
