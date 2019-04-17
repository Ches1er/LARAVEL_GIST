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

                <!--All categories -->

                <h3>All categories list</h3>
                <select name="select" id="">
                @foreach($categories as $category)
                    <option>{{$category->name}}</option>
                @endforeach
                </select>
                <hr />

                <!--Add new category -->

                <h3>Add new category</h3>
                <form action="/addnewcat" method="post">
                    @csrf
                    <label for="name">Add category</label>
                    <input type="text" name="name">
                    <input type="submit" value="Add">
                </form>
                <hr />

                <!--Change category name -->

                <h3>Change category name</h3>
                <form action="/changecatname" method="post">
                    @csrf
                    <label for="cat_name">Category name</label>
                    <input type="text" name="cat_name">
                    <label for="cat_name">New category name</label>
                    <input type="text" name="new_cat_name">
                    <input type="submit" value="Change">
                </form>
                <hr />

            </div>


            <!-- Find user and ban/unban -->

            <div class="admin_block">
                <h3>Find user</h3>
                <form action="/admin" method="get">
                    @csrf
                    <label for="name">Find user</label>
                    <input type="text" name="name">
                    <input type="submit" value="Find">
                </form>
                <hr />
                @if(is_null($found_user))
                    @else
                    <div class="found_user">
                        <table class="found_user_table">
                            <tr>
                                <th class="col_login">Login</th>
                                <th class="col_email">Email</th>
                                <th class="col_status">Status</th>
                            </tr>
                            <tr>
                                <td class="col_login">{{$found_user->name}}</td>
                                <td class="col_email">{{$found_user->email}}</td>
                                <td class="col_status">{{$found_user->roles()[0]}}</td>
                            </tr>
                        </table>
                        @if(in_array("Invalid",$found_user->roles()))

                            <form class="found_user_ban" action="/admin/unban" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$found_user->id}}">
                                <input type="submit" value="Unban user">
                            </form>

                            @else
                        <form class="found_user_ban" action="/admin/ban" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$found_user->id}}">
                            <input type="submit" value="Ban user">

                        </form>
                        @endif
                    </div>
                    @endif
            </div>
        </div>
@endsection
