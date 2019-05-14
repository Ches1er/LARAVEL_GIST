@extends("layouts.default")
@section("content")
    <section>
        <div class="page_error">
            <div class="page_error_text">
                Sorry, but this is private gist.
            </div>
            <div class="page_error_text">
                You are able to view only public or your private gists.
            </div>
            <div class="page_error_main">
                <a href="{{route('main')}}">To Main page</a>
            </div>
        </div>
    </section>
@endsection
