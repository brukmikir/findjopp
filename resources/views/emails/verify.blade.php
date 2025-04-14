<x-mail::message>
# Introduction

Congratulation! you are now a premium user.
<p>your purchase details</p>
<p>your plan: {{$plan}}</p>
<p>your plan ends on: {{$billingEnds}}</p>
<x-mail::button :url="''">
post a jop
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
