<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use Auth;
use Hash;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    use APIResponseTrait;
    public function register(Request $request)
    {
        // if (isset($request->validator) && $request->validator->fails())
        // {
        //     return $this->APIResponse(null , $request->validator->messages() ,  400);
        // }
        // return $request->password;
        $request['password'] = bcrypt($request->password);
        // return $request->all();
        $patient = Patient::create($request->all());
        $data['token'] = $patient->createToken('token')->accessToken;
        return $this->APIResponse($data, null, 200);
    }

    public function login(Request $request)
    {
        $field = 'phone';

        if (is_numeric($request->input('phone'))) {
            $field = 'phone';
        } elseif (filter_var($request->input('phone'), FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        }

        $request->merge([$field => $request->input('user_name')]);

        if (!Auth::guard('patient')->attempt($request->only($field, 'password'))) {
            $error = "Unauthorized";
            return $this->APIResponse(null, $error, 400);
        }
        $patient = Patient::where($field, request('phone'))->first();

        $success['token'] = $patient->createToken('token')->accessToken;
        return $this->APIResponse($success, null, 200);
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
        return $this->APIResponse(Patient::findOrFail(Auth::guard('patient-api')->user()->id), null, 200);

    }

    protected function uploadFile($request, $height = 400, $width = 400)
    {

        $photo = $request->file('image');
        $fileName = time() . str_random('10') . '.' . $photo->getClientOriginalExtension();
        $destinationPath = public_path('uploads/' . $this->getClassNameFromModel() . '/');
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath);
        }
        $photo->move($destinationPath, $fileName);
        return 'uploads/' . $this->getClassNameFromModel() . '/' . $fileName;
    }
}
