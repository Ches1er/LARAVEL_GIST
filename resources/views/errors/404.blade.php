@extends("layouts.default")
@section("content")
    <section>
<div class="page_error">
    <div class="page_error_text">
        The page your looking for is not available =(
    </div>
<div class="page_error_main">
    <a href="{{route('main')}}">Back to the Main</a>
</div>
</div>
    </section>
    @endsection

