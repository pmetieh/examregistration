<?php

namespace App;
use App\County;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //
    protected $fillable = ['county_id', 'districtName'];

    public function county()
    {
    	return $this->belongsTo(County::class);
    }
}
