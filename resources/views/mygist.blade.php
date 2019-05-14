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
            @if(session('message'))
                <div class="message">{{session('message')}}</div>
            @endif
            <hr />
            <table class="my_files_table">
                <?php $caption=count($files)>0?"Gist contents next files:":"Gist doesnt have any files yet:"?>
                <caption>{{$caption}}</caption>
                @forelse($files as $file)
                <tr>
                    <td><a class="gist_file" href="{{route('showfile',['file_id'=>$file->id])}}">{{$file->name}}</a></td>
                    <td>
                        <form action="{{route('delfile',['file_id'=>$file->id])}}" method="post">
                            @method("delete")
                            @csrf
                            <input type="submit" value="Delete file">
                        </form>
                    </td>
                </tr>
                @empty

                @endforelse
            </table>
            <div class="add_new">
                <h3>Add new file</h3>
                <form action="{{route('addfile')}}" method="post">
                    @csrf
                    <input type="hidden" name="gist_id" value="{{$gist->id}}">
                    Add file name:<input type="text" name="name" placeholder="File name..." value="{{old('name')}}">
                    @if($errors->has('name'))
                        <span class="validation_error">{{$errors->first('name')}}</span>
                    @endif
                    Add file content:<textarea name="content"></textarea>
                    @if($errors->has('content'))
                        <span class="validation_error">{{$errors->first('content')}}</span>
                    @endif
                    <input type="submit" value="Add">
                </form>
            </div>
        </div>
    </section>
@endsection




