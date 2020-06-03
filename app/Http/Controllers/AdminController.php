<?php

namespace App\Http\Controllers;
use App\Http\Controllers\APIResponseTrait;
use Illuminate\Http\Request;
use Auth ;
use App\Models\User;
use App\Models\Hospital;
class AdminController extends Controller
{
    use APIResponseTrait;
    public function login(Request $request)
    {
        $field = 'user_name';
        if (is_numeric($request->input('user_name'))) {
            $field = 'phone';
        } elseif (filter_var($request->input('user_name'), FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        }

        $request->merge([$field => $request->input('user_name')]);
        // return $field ;
        if (!Auth::guard('web')->attempt($request->only($field, 'password'))) {
            $error = "Unauthorized";
            return $this->APIResponse(null, $error, 401);
        }
        $patient = User::where($field, request('user_name'))->first();

        $success['token'] = $patient->createToken('token')->accessToken;
        return $this->APIResponse($success, null, 200);
    }

    public function index()
    {
        if(isset(Auth::guard('api')->user()->id)){
        return $this->APIResponse( Hospital::all(), null, 200);
        }
        else{
            return $this->APIResponse(null, "not send token or not authorized", 401);
        }
    }
    public function approveHospital($id)
    {
        if(isset(Auth::guard('api')->user()->id)){
            $hospital = Hospital::find($id);
            if(isset($hospital)){
                $hospital->is_approved= 1 ; $hospital->save();
                return $this->APIResponse(null, null, 200);
            }
            else
            return $this->APIResponse(null, "hospital not found", 400);
        }
        else{
            return $this->APIResponse(null, "not send token or not authorized", 401);
        }
    }
}
