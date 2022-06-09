@component('mail::message')
# Paymennt Completion Notice

Congratulations {{ $user["fName"] }} {{ $user["lName"]}} you have successfully completed payment.
You will now be redirected to the Biodata Input form.

@component('mail::button', ['url' => 'http://examregistration.ul.edu.lr'])
Click here for further enquiries
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
