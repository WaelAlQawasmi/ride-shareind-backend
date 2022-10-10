<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{    

    use AuthenticatesUsers;

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(),$this->validation('rig'),$this->masseges('rig'));
 

        if ($validator->fails()) {
            return $validator->errors();
        }

        $data = $request->validate($this->validation('rig'));
        $request['isactive']=true;

         $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        $token = $user->createToken('API Token')->accessToken;

        return response([ 'user' => $user, 'token' => $token]);
    }


    

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(),$this->validation('login'),$this->masseges('login'));
 

        if ($validator->fails()) {
            return $validator->errors();
        }


         $data = $request->validate($this->validation('login'));
       

        if (!auth()->attempt($data)) {
            return response(['error_message' => 'Incorrect Details ! Please try again']);
        }

        $token = auth()->user()->createToken('Laravel-9-Passport-Auth')->accessToken;
        return response()->json(['token' => $token], 200);

        return response(['user' => auth()->user(), 'token' => $token]);

    }



    protected function validation($used){
        if($used=='login')
        return[
            'phone' => 'required',
            'password' => 'required'
        ];
        else
        return[
            'phone' => 'required|unique:users',
            'password' => 'required',
            'name' => 'required|max:255',
        ]; 
    }



    protected function masseges($used){
        if($used=='login')
        return[
                'phone.required' => 'We need to know your phone!',
                'password.required' => 'We need to know your password!',
          
        ];
        else
        return[
            'phone.unique:users' => 'alredy used!',
            'phone.required' => 'We need to know your phone!',
            'password.required' => 'We need to know your password!',
            'name.required' => 'We need to know your name!',
            'name.max:255' => 'must 255!',
        ]; 
    }


    public function username()
    {
        return 'phone';
    }
}
