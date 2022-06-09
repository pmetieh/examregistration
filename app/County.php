<?php

namespace App;
use App\District;


use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    //
    protected $fillable = ['countyName'];

    public function districts()
    {
    	return $this->hasMany(District::class);
    }
}
