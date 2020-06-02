<?php

namespace App\Http\Controllers;
use App\Http\Controllers\APIResponseTrait;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    use APIResponseTrait;
    public function register(Request $request)
    {
        
        $request['password'] = bcrypt($request->password);
        Hospital::create($request->all());
        return $this->APIResponse(null, null, 200);
    }
}
