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

@section("title","profile")

@section("content")
    <nav>@yield("menu")</nav>
    <h3>{{Auth::user()->name}}'s Profile</h3>
    <div class="main_profile_content">
        <div class="upic"><img class="large_avatar" src="{{$upic_path->path}}" alt=""></div>
        <div class="changepic">
            <h3>Change user picture</h3>
            <form enctype="multipart/form-data" action="/addpic" method="POST">
                @csrf
                <!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла -->
                <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
                <!-- Название элемента input определяет имя в массиве $_FILES -->
                <input name="userfile" type="file" />
                <input type="submit" value="Добавить картинку" />
            </form>
        </div>

        <div class="change_name">
            <h3>Change login</h3>
            <form action="/changename" method="post">
                @csrf
                @method("put")
                <input type="text" name="name">
                <input type="submit" value="Change name">
            </form>
        </div>
    </div>
@endsection
