@component('mail::message')
# UL Entrance Exam Notification

<b>Congratulations {{ $user->firstName }} {{ $user->lastName}}</b> on successfully registering for the UL entrance exam.<br/>
Your exam number is : {{ $user->examNo }} <br/>
You have been assigned the following testing  center: {{ $user->tcName}} <br>
Located at : {{ $user->tcLocation}} <br>
The exam date is : {{ date('Y m d')}} <br>



@component('mail::button', ['url' => 'http://ul.edu.lr/'])
UL Website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
