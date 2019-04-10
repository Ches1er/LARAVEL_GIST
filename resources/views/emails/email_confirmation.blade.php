@component('mail::message')
    <h3>Email confirmation letter</h3>>

Congratulations {{$name}}, you have almost registrated.
Finally you must push the button.

@component('mail::button', ['url' => $url])
Email confirmation!
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
