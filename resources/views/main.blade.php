@extends("layouts.default")

@include("layouts.menus.menu")


@section("title","Main")
@section("content")
    <footer>
        <h1 class="display-6 m-3 text-primary">My GistHub</h1>
    </footer>
    <nav>@yield("menu")</nav>
    <div class="container row align-content-center">
        <aside class="col-4">
            <ul class="list-group">
                <li class="list-group-item"><a href="/showcat/all">All</a></li>
                @foreach($categories as $category)
                    <li class="list-group-item"><a href="{{route("showcat",['caturl'=>$category->name])}}">{{$category->name}}</a></li>
                @endforeach
            </ul>
        </aside>

        <div class="col-6">
            <div class="about_resource">About project...</div>
            <div class="gists">
            @forelse($gists as $gist)
                <div class="full_info_container">
                    <div class="gist_container">
                        <a class="gist_name" href="{{route("showgist",["gistid"=>$gist->id])}}">{{$gist->name}}</a>
                        <div class="gist_author">Author:</div>
                        <div class="gist_date"><?=date('d-m-y h:m:s',$gist->date)?></div>
                        <div class="gist_desc">{{$gist->desc}}</div>
                        <div class="file_count"><?="Number of files: ".count($gist->files)?></div>
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

    </div>
@endsection
