@extends("layouts.default")

@section('content')
        <div class="login_register_container">
            <div class="container_heading">Login</div>
            <form class="login_register_form" action="{{ route('login') }}" method="post">
                @csrf
                @if(session()->has('login_error'))
                    <span class="validation_error">
                        {{ session()->get('login_error') }}
                    </span>
                @endif
                 <label for="identity">Username</label>
                        <input id="identity" type="identity" name="identity"
                               value="{{ old('identity') }}" autofocus>
                        @if ($errors->has('identity'))
                                    <span class="login_register_error">
                                        <strong>{{ $errors->first('identity') }}</strong>
                                    </span>
                        @endif

                <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password">
                    @if ($errors->has('password'))
                        <span class="validation_error">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

                <label class="remember_me">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>

                <button type="submit">Login</button>

                <a href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
                <a href="{{ route('register') }}">
                    Register
                </a>
                <a href="{{ route('main') }}">
                    Back to Main page
                </a>

            </form>
        </div>
@endsection
