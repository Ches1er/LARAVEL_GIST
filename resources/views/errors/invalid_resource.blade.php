@extends("layouts.default")
@section("content")
    <section>
        <div class="page_error">
            <div class="page_error_text">
                Sorry, but this is not your gist or file.
            </div>
            <div class="page_error_text">
                You only able to view another user gists or files.
            </div>
            <div class="page_error_text">
                Nor modify their!
            </div>
            <div class="page_error_main">
                <a href="{{route('main')}}">To Main page</a>
            </div>
        </div>
    </section>
@endsection

