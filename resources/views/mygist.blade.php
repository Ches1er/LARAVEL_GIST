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
            <table class="my_files_table">
                <?php $caption=count($files)>0?"Gist contents next files:":"Gist doesnt have any files yet:"?>
                <caption>{{$caption}}</caption>
                @forelse($files as $file)
                <tr>
                    <td><a class="gist_file" href="files/showfile/{{$file->id}}">{{$file->name}}</a></td>
                    <td>
                        <form action="files/delfile/{{$file->id}}" method="post">
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
                    Add file name:<input type="text" name="file_name" placeholder="File name..." value="{{old('name')}}">
                    @if($errors->has('file_name'))
                        <span class="validation_error">{{$errors->first('file_name')}}</span>
                    @endif
                    Add file content:<textarea name="file_content"></textarea>
                    @if($errors->has('file_content'))
                        <span class="validation_error">{{$errors->first('file_content')}}</span>
                    @endif
                    <input type="submit" value="Add">
                </form>
            </div>
        </div>
    </section>
@endsection




