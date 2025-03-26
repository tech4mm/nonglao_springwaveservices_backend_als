<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Composer\Autoload\ClassLoader;
use PhpParser\Node\Stmt\TryCatch;

// require_once('vendor/autoload.php');

class ApiController extends Controller
{
    // otp register
    public function otp_register(Request $request){
        $request-> validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:users,phone',
            'password' => 'required|string|min:6',
        ]);
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://otp.thaibulksms.com/v2/otp/request', [
        'form_params' => [
            'key' => '1825361649636880',
            'secret' => 'd4ce6d0f1a3a4f43cb5b6c2aea146084',
            'msisdn' => $request->phone
        ],
        'headers' => [
            'accept' => 'application/json',
            'content-type' => 'application/x-www-form-urlencoded',
        ],
        ]);

        echo $response->getBody();
    }


    // register
    public function register(Request $request){
        $request-> validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:users,phone',
            'password' => 'required|string|min:6',
            'token' => 'required|string',
            'pin' => 'required|string',
        ]);


        // check otp

        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://otp.thaibulksms.com/v2/otp/verify', [
        'form_params' => [
            'key' => '1825361649636880',
            'secret' => 'd4ce6d0f1a3a4f43cb5b6c2aea146084',
            'token' => $request->token,
            'pin' => $request->pin,
        ],
        'headers' => [
            'accept' => 'application/json',
            'content-type' => 'application/x-www-form-urlencoded',
        ],
        ]);

        // echo $response->getBody();
        //echo $response->getStatusCode();

        // check otp done
        if($response->getStatusCode() == 200){
            User::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'User register successfully.'
        ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'OTP invalid',
            ]);
        }
    }

    // login
    public function login(Request $request){
        $request -> validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        // check email from db
        $user = User::where('phone', $request->phone) -> first();

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
                'message' => 'Phone invalid',
            ]);
        }
    }

    // get profile
    public function profile(){
        $userdata = auth()->user();
        return response() -> json([
            'status' => true,
            'message' => 'User data',
            'data' =>  $userdata,
        ]);
    }

    // update profile
    public function update_profile(Request $request){
        $user = auth()->user();

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'password' => 'sometimes|string|min:6',
            'profile_pic' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            try {
                //code...
                // $file->storeAs('public/profile_pics', $filename);
                //Storage::disk('public')->putFileAs('profile_pics', $file, $filename);
                $file->storeAs('profile_pics', $filename, 'public');
                $user->user_picture = 'profile_pics/' . $filename;
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json([
                    'status' => false,
                    'message' => 'Profile picture not uploaded',
                ]);
            }
        }

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully',
            'data' => $user,
        ]);
    }


    // otp_forgot_password
    public function otp_forgot_password(Request $request){
        $request->validate([
            'phone' => 'required|string',
        ]);

        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Wrong number, user not found',
            ], 404);
        }
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://otp.thaibulksms.com/v2/otp/request', [
        'form_params' => [
            'key' => '1825361649636880',
            'secret' => 'd4ce6d0f1a3a4f43cb5b6c2aea146084',
            'msisdn' => $request->phone
        ],
        'headers' => [
            'accept' => 'application/json',
            'content-type' => 'application/x-www-form-urlencoded',
        ],
        ]);

        echo $response->getBody();
        // $otp = rand(100000, 999999);
        // $user->otp_code = $otp;
        // $user->save();

        // return response()->json([
        //     'status' => true,
        //     'message' => 'OTP sent successfully',
        //     'otp' => $otp, // Remove this in production for security reasons
        // ]);
    }

    // forgot password
    public function forgot_password(Request $request){
        $request->validate([
            'phone' => 'required|string',
            'token' => 'required|string',
            'pin' => 'required|string',
            'password' => 'required|string|min:6|confirmed', // Ensure password confirmation
        ]);
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://otp.thaibulksms.com/v2/otp/verify', [
        'form_params' => [
            'key' => '1825361649636880',
            'secret' => 'd4ce6d0f1a3a4f43cb5b6c2aea146084',
            'token' => $request->token,
            'pin' => $request->pin,
        ],
        'headers' => [
            'accept' => 'application/json',
            'content-type' => 'application/x-www-form-urlencoded',
        ],
        ]);

        // check otp done
        if($response->getStatusCode() == 200){
            $user = User::where('phone', $request->phone)->first();
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Password reset successfully',
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'OTP invalid',
            ]);
        }


        // $user = User::where('phone', $request->phone)->first();

        // if (!$user) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Wrong number, user not found',
        //     ], 404);
        // }
        // $otp = rand(100000, 999999);
        // $user->otp_code = $otp;
        // $user->save();

        // return response()->json([
        //     'status' => true,
        //     'message' => 'OTP sent successfully',
        //     'otp' => $otp, // Remove this in production for security reasons
        // ]);
    }

    // logout
    public function logout(){
        auth() -> user() -> tokens() -> delete();
        return response() -> json([
            'status' => true,
            'message' => 'Logout successfully',
        ]);
    }


}
