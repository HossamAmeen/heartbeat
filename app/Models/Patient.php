<?php

namespace App\Models;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\Model;

class Patient extends Authenticatable
{
    // use LaratrustUserTrait;
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'first_name' , 'last_name' ,
        'email' , 'password' ,
        'phone' ,'phone2' ,
        'birth_date',
        'gender','national_id',
    'address', 'address2' , 'money','job', 'image'
    ,"is_block","block_reason",'city_id'
    ];
    protected $hidden = [
        'password',
    ];

}
