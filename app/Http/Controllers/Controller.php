<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
        $user = User::where('username', $request->input('username'))->first();

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
