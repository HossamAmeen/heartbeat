<?php

namespace App\Http\Controllers;
use App\Http\Controllers\APIResponseTrait;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
class HospitalController extends Controller
{
    use APIResponseTrait;

    public function login(Request $request)
    {
        $field = 'manager_phone';
        if (is_numeric($request->input('user_name'))) {
            $field = 'manager_phone';
        } elseif (filter_var($request->input('user_name'), FILTER_VALIDATE_EMAIL)) {
            $field = 'manager_email';
        }

        $request->merge([$field => $request->input('user_name')]);

        if (!Auth::guard('hospital')->attempt($request->only($field, 'password'))) {
            $error = "Unauthorized";
            return $this->APIResponse(null, $error, 401);
        }
        $patient = Hospital::where($field, request('user_name'))->first();

        $success['token'] = $patient->createToken('token')->accessToken;
        return $this->APIResponse($success, null, 200);
    }

    public function index()
    {
        return $this->APIResponse( Hospital::all(), null, 200);
    }
    
    public function store(Request $request)
    {
        
        $request['password'] = bcrypt($request->password);
        Hospital::create($request->all());
        return $this->APIResponse(null, null, 200);
    }
    public function updateAccount(Request $request)
    {
        $row = Patient::findOrFail(Auth::guard('patient-api')->user()->id);
        $requestArray = $request->all();
        if (isset($requestArray['password']) && $requestArray['password'] != "") {
            $requestArray['password'] = Hash::make($requestArray['password']);
        } else {
            unset($requestArray['password']);
        }
        if (isset($requestArray['image']) ){
            $requestArray['image'] = $this->uploadFile($request);
        }
        $row->update($requestArray);

        return $this->APIResponse(null, null, 200);
    }

    public function getAccount()
    {
        if(isset(Auth::guard('hospital-api')->user()->id))
        return $this->APIResponse(Hospital::findOrFail(Auth::guard('hospital-api')->user()->id), null, 200);
        else{
            return $this->APIResponse(null, "not send token or not authorized", 401);
        }
    }

}
