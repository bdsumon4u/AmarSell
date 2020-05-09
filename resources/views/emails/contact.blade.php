@component('mail::message')
# {{ $data['subject'] }}

{{ $data['message'] }}

From,<br>
{{ $data['email'] }}
@endcomponent