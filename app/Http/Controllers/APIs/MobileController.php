<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MobileController extends Controller
{
    use APIResponseTrait;

    public function complaint(Request $request)
    {
        \App\Models\Complaint::create($request->all());
        return $this->APIResponse(null, null, 200);
    }
    public function cities()
    {
        return $this->APIResponse(City::all(), null, 201);
    }

}
