<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller

{
public function quickRandom($length = 16) 
    { $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length); 
    }


    //Login
    public function login(Request $request){

       
       $email = $request->email;
       $password = $request->password;

       $this->validate ($request,[
           'email' => 'required|email|exists:users,email',
           'password' =>'required|min:6|alpha_num'
       ], [
           'email.required' => 'You need to enter an existing email or please, sign up!',
           'password.required' => 'You need to enter a valid password!!'
       ]);

       
       $user = User::where([
           'email' => $email,
       ])->first();

    
       
       if(!$user || !Hash::check($password, $user->password)){
        return response()->json(['message' => 'You are not authorised'], 401);
       }


       $token = $this->quickRandom(16);
       $user->accessTokens=$token;
       $user->save();
       return response()->json(["accessTokens" => $user->accessTokens]);

       }


    //Logout
    public function logout(Request $request){

        $user = $request->user();
        $user->accessTokens= null;
       
        $user->save();
        
        return response()->json(
            'You are logged out!!'
        );
    }
    

    //Refresh
    public function refresh(Request $request){
        $user = $request->user();

        if ($user){
            $token = $this->quickRandom(16);
            $user->accessTokens=$token;
       $user->save();
       return response()->json($user->accessTokens);

        }

        
    }
       //Register
       public function register( Request $request) {
        $this->validate($request,[
            'firstName' => 'required| string',
            'lastName' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|alpha_num'
        ]);

        $user = new User();
        $user->firstName=$request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->email= $request->input('email');
        $user->password = $request->input('password');

        $splitEmail = explode('@' , $user->email);
        $domain = $splitEmail[1];
        $business = Business::where('domain', $domain)->first();
        if ($business && $domain === $business->domain){
            $business->users()->save($user);
            return response()->json($user , 200);
        } else {
            return response()->json('Your organisation does not exist!.', 400);
        }
    
        
    }

}
    