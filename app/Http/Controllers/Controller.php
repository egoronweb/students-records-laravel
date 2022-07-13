<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Illuminate\Http\Request;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $users = User::all();

        return response()->json([
            'status' => 200,
            'users' => $users,
        ]);
    }

    public function create(Request $request){
        $user = new User;
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json([
            'status' => 200,
            'message' => 'Successfully Added',
        ]);
    }


    public function userLogin(Request $request){
        $user = User::where('email', $request->input('email'))->first();

        if(!$user || !Hash::check($request->input('password'), $user->password)){
            return response()->json([
                'status' => 401,
                'response' => 'Invalid Credentials',
            ]);
        }else{
            $token = $user->createToken('Auth Token')->accessToken;
            return response()->json([
                'status' => 200,
                'token' =>$token,
            ]);
        }
    }
}
