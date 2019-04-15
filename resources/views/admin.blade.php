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


@section("title","Admin")
@section("content")
    <nav>@yield("menu")</nav>
    <h3>Admin menu</h3>
        <div class="main_admin_content">
            <div class="admin_block">
                <h3>All categories list</h3>
                <select name="select" id="">
                @foreach($categories as $category)
                    <option>{{$category->name}}</option>
                @endforeach
                </select>
            </div>
            <div class="admin_block">
                <h3>Add new category</h3>
                    <form action="/addnewcat" method="post">
                        @csrf
                        <label for="name">Add category</label>
                        <input type="text" name="name">
                        <input type="submit" value="Add">
                    </form>
            </div>
            <div class="admin_block">
                <h3>Find user</h3>
                <form action="/admin" method="get">
                    @csrf
                    <label for="name">Add category</label>
                    <input type="text" name="name">
                    <input type="submit" value="Find">
                </form>
                @if(is_null($found_user))
                    @else
                    <div class="admin_user_name">
                        {{$found_user->name}}

                    </div>
                    @endif

            </div>
        </div>
@endsection

