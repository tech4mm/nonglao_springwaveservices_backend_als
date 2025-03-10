<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function register(Request $request){
        $request-> validate([
            'name'=> 'required|string',
            'email' => 'required|email|unique:users,email',
            'password'=> 'required|confirmed',
        ]);
        User::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'User register successfully.'
        ]);
    }


    public function login(Request $request){
        $request -> validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // check email from db
        $user = User::where('email', $request-> email) -> first();

        if(!empty($user)){
            // password check
            if(Hash::check($request-> password, $user -> password)){
                $token = $user-> createToken('api') -> plainTextToken;
                return response() -> json([
                    'status' => true,
                    'message' => 'Logined successfully',
                    'token' => $token,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Password mitmatch',
                ]);
            }
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Eamil invalid',
            ]);
        }
    }

    public function profile(){
        $userdata = auth() -> user();
        return response() -> json([
            'status' => true,
            'message' => 'User data',
            'data' =>  $userdata,
        ]);
    }

    public function logout(){
        auth() -> user() -> tokens() -> delete();
        return response() -> json([
            'status' => true,
            'message' => 'Logout successfully',
        ]);
    }
}
