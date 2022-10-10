<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class UserAuthController extends Controller
{

    public function register(Request $request)
    {

        $data = $request->validate([
           
            'name' => 'required|max:255',
    
            'email' => 'required|email|unique:users',
          
        ]);
        $request['isactive']=true;

         $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        $token = $user->createToken('API Token')->accessToken;

        return response([ 'user' => $user, 'token' => $token]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($data)) {
            return response(['error_message' => 'Incorrect Details. 
            Please try again']);
        }

        $token = auth()->user()->createToken('Laravel-9-Passport-Auth')->accessToken;
        return response()->json(['token' => $token], 200);

        return response(['user' => auth()->user(), 'token' => $token]);

    }
}
