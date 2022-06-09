<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\UnderGrad;
use App\Grad;
use App\Payment;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'name', 'email', 'password', 'firstName', 'otherName',
            'lastName', 'dob','gender', 'mobileNo', 'emergencyNo1', 
            'emergencyNo2', 'maritalStatus','countyOfO', 'nationality'
         ];

    /**
     * The attributes that should be hidden for arrays.
     *, 'highSchool'
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function assignStudentRole($userId, $roleId)
    {
        //dd($request);
    $insertid = DB::table('role_user')->insertGetId(array('role_id'=>$roleId, 'user_id' =>$userId));
        //
        if($insertid){
            return true;
        }else{
            return false;
        }
        


    }

     public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'This action is unauthorized.');
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }


    public function roles()
    {
        return $this
            ->belongsToMany('App\Role')
            ->withTimestamps();
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function undergrad()
    {
        return $this->hasOne(UnderGrad::class);
    }
 
    public function grad()
    {
        return $this->hasOne(Grad::class);
    }

    //the relationship between user and testingcenter is one to one
    //i.e a user can only be assigned to one testing center at a time

    public function testingcenter()
    {
        return $this->belongsTo(TestingCenter::class);
    }

}
