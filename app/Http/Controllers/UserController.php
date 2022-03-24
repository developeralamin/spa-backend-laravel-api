<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function login(Request $request)
    {
        

    	  $user = User::where('email',$request->email)->first();

    	  if($user  && Hash::check($request->password,$user->password)){
    	  	   $token = $user->createToken('auth_token')->plainTextToken;
    	  	   // [$response,$token]
    	  	  $response=[
    	  	  	'user' =>$user,
    	  	  	'token' => $token
    	  	  ];

    	  	   return response()->json($response,200);
    	  }else{

            return response()->json([
                'error' =>'Invalid credential'
            ],422);
            
          }

    
    }


// sign up new user
// sign up new user

        public function sign_up(Request $request)
        {

        $this->validate($request, [
            'email' => 'required|unique:users',
         ]);

        $isUniqueEmail = User::where('email',$request->email)->first();
         
        if($isUniqueEmail){

         // return response()->json([
         //    'error' =>'Email has already exists'
         // ],422);

        }
        else{
               $user = new User();

             $user->name = $request->name;
             $user->email = $request->email;
             $user->password =Hash::make($request->password) ;

             $user->save();

             return response()->json([
               'message' => 'Successfully registered',
           ], 200);

        } 

          
        }

}
