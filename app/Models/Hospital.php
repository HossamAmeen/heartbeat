<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = ['name' ,'address' ,'city' ,'phone' ,'manager_name', 'manager_phone' ,'manager_email',
    
     'password', 'type','is_government' ,'number_of_beds'];
}
