<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobilePayment extends Model
{
    //
     protected $fillable = ['fName','lName','email','mobileNo','amntpaid','currency','description'];
}
