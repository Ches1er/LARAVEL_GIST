@extends("layouts.default")
@section("content")
    <section>
        <div class="page_error">
            <div class="page_error_text">
                Sorry, but you`re not a valid user. Connect as by email
            </div>
            <div class="page_error_main">
                <a href="{{route('main')}}">To Main page</a>
            </div>
        </div>
    </section>
@endsection