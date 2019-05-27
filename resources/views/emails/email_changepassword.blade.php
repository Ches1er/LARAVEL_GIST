@component('mail::message')
    <h3>Password changing</h3>>

    {{$name}}, if you really want to change password,
    push "Change password" button.

    @component('mail::button', ['url' => $url_accepted])
        Change password
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
