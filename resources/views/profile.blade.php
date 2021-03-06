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

        <!--Verify email-->

        @if(Auth::user()->email_verified_at===null)
            <div class="page_error_text">Your email doesnt verified. You cant publish gists.</div>
            <form action="{{route('verification_mail_repeat')}}" method="get">
                @csrf
                <input type="submit" value="Send me verification email again">
            </form>
        @endif


        <form action="{{route('get_token')}}" method="post">
            @csrf
            <input type="submit" value="Send me token">

            <!--For api test -->

            <a href="/api/myauth">Check api token</a>
            <a href="/api/myauth/admin">Check api token w admin</a>

        </form>



        <div class="upic"><img class="large_avatar" src="{{Auth::user()->getPic()->path }}" alt=""></div>
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
                <input type="text" name="name" value="{{old('name')}}">
                @if($errors->has('name'))
                    <span class="validation_error">{{$errors->first('name')}}</span>
                @endif
                <input type="submit" value="Change name">
            </form>
        </div>

        <div class="change_name">
            <h3>Change pass</h3>
            @if(!empty($error))
                <div class="page_error_text">
                    {{$error}}
                </div>
            @endif
            <form action="{{route('changepassword')}}" method="post">
                @csrf
                @method("put")
                <input type="text" name="new_password">
                <input type="submit" value="Change password">
            </form>
        </div>
    </div>
@endsection
