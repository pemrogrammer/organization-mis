@component('mail::message')
# Reset Password

Silahkan klik tombol di bawah untuk mereset password.

@component('mail::button', ['url' => $url])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
