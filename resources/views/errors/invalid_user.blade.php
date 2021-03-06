@extends("layouts.default")
@section("content")
    <section>
        <div class="page_error">
            <div class="page_error_text">
                Sorry, but you`re not a valid user.
            </div>
            <div class="page_error_text">
                You`re not able to create gists, or modify profile.
            </div>
            <div class="page_error_text">
                For changing your status please connect with us by email.
            </div>
            <div class="page_error_main">
                <a href="{{route('main')}}">To Main page</a>
            </div>
        </div>
    </section>
@endsection
