<?php

namespace App\Models;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Hospital extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $fillable = ['name' ,'address' ,'city' ,'phone' ,'manager_name', 'manager_phone' ,
    'manager_email','password', 'type','is_government' ,'number_of_intensive_care_beds' 
    , 'number_of_medium_care_beds' ,'number_of_interior_care_beds'];
}
