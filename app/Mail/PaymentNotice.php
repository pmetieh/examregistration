<?php

namespace App\Mail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
//use App\User;
class PaymentNotice extends Mailable
{
    use Queueable, SerializesModels;

     public $_user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
       // return "Payment Notice Mailable";
       // dd($user);
        $this->_user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->_user;//(object)
        //var_dump(compact('user'));
       // dd($user['customerFirstName']);
        return $this->markdown('mail.paymentnotice', compact('user'));  //['user'=>$user]
    }
}
 