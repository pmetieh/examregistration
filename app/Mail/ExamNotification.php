<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
//use Auth;
use Illuminate\Support\Facades\Auth;
use App\User;
class ExamNotification extends Mailable
{
    use Queueable, SerializesModels;

     public $user;
    // $user = Auth::User();
   //  public $x = 'public variable $x';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        echo  'From mailable constructor '.'<br/>';
        $this->user = $user;
       // dd($this->user);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       echo 'From build function()';
       //query the database and get the transactionId

        $user = $this->user;
       // $email = DB::table('txnref')->where('email',$user->email);
        $ugradExamNo = $user->undergrad->examNo;
        $user['examNo'] = $ugradExamNo;
       // dd( $user['examNo']);
        echo 'Sending email ...'.'<br>';
        return $this->markdown('mail.examnotification', compact('user')); //; //
    }
}
