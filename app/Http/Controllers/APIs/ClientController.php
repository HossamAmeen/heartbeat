<?php

namespace App\Http\Controllers\APIs;
use App\Http\Controllers\APIResponseTrait;
use App\Models\Client;
use App\Models\Order;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
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
        $client = Client::create($request->all());
        auth()->login($client);
        $success['token'] =  $client->createToken('token')->accessToken;

        return $this->APIResponse($success, null, 200);
        return response()->json($success, 200);
    }

    public function login()
    {
        $field = 'phone';

        if (is_numeric($request->input('phone'))) {
            $field = 'phone';
        } elseif (filter_var($request->input('phone'), FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        }

        $request->merge([$field => $request->input('phone')]);

        if (!Auth::guard('client')->attempt($request->only($field, 'password'))) {
            $error = "Unauthorized";
            return $this->APIResponse(null, $error, 400);
        }
        $client = Client::where($field, request('phone'))->first();

        $success['token'] = $client->createToken('token')->accessToken;
        return $this->APIResponse($success, null, 200);
    }

    public function loginStudy(){ 
        $credentials = request(['phone', 'password']);

        if(Auth::attempt($credentials, false, false)){
            $user = Auth::user(); 
            // return $user;
            $success['token'] =  $user->createToken('token')-> accessToken; 
            return $this->APIResponse($success, null, 200);
            // return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            // $client = Client::where("phone", request('phone'))->first();
            // return $client;
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    public function getAccount()
    {
        $client = Client::findOrFail(Auth::guard('client-api')->user()->id);
        return $this->APIResponse($client, null, 201);
    }
    public function updateAccount(Request $request)
    {
        Client::find(Auth::guard('client-api')->user()->id)->update($request->all());
        return $this->APIResponse(null, null, 201);

    }
    public function showOrders()
    {
        $order = Order::where('client_id' , Auth::guard('client-api')->user()->id)
        ->get();

        return $this->APIResponse($order, null, 201);
    }
    
    public function addOrder(Request $request)
    {
        $request['client_id'] = Auth::guard('client-api')->user()->id;
        Order::create($request->all());
        return $this->APIResponse(null, null, 201);
    }

    public function addRate(Request $request , $id)
    {
        $order = Order::findOrFail($id);
        $order->rate =  $request->rate ;
        $order->review =  $request->review ; 
        $order->save();
       
        return $this->APIResponse(null, null, 201);
    }
}
