@component('mail::message')
# Introduction

BloodBank Reset Password;

@component('mail::button', ['url' => 'http://facebook.com'])
Rest
@endcomponent

   <p>Your Reset password is : {{$code}}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
