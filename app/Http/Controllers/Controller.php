<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, HasApiTokens;

    public function index(){
        $users = User::all();

        return response()->json([
            'status' => 200,
            'users' => $users,
        ]);
    }

    public function create(Request $request){
        $user = new User;

        if($request->input('password') === $request->input('re_password')){
            $user->fullname = $request->input('fullname');
            $user->username = $request->input('username');

            $user->password = Hash::make($request->input('password'));
            $user->save();

            return response()->json([
                'status' => 200,
                'message' => 'Successfully Added',
            ]);
        }else{
            return response()->json([
                'status' => 401,
                'message' => 'Please check your password!'
            ]);
        }
    }



    public function userLogin(Request $request){
        $user = User::where('username', $request->input('username'))->first();

        if(!$user || !Hash::check($request->input('password'), $user->password)){
            return response()->json([
                'status' => 401,
                'response' => 'Invalid Credentials',
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'user' => $user,
            ]);
        }
    }
}
