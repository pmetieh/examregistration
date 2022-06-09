<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MomoResponse extends Model
{
    //
    protected $fillable  = ['amount','phoneNo','financialTransactionId','referenceNo','payeeNote','currency','status'];
}
