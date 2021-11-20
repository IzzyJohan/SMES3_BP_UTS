<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    #Fungsi register menggunakan nama, email, password
    public function register(Request $request)
    {
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) #enkrip password
        ];

        $user = User::create($input);

        $data = [
            'message' => 'Register is succesful'
        ];

        return response()->json($data, 200);
    }

    #Fungsi Login dengan email dan password 
    public function login(Request $request)
    {
        $input = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $user = User::where('email', $input['email'])->first();

        if ($input['email'] == $user->email && Hash::check($input['password'], $user->password)) {
            $token = $user->createToken('auth_token');   

            $data = [
                'message' => 'Login is succcessfully',
                'token' => $token->plainTextToken
            ];
        
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Login is invalid',
            ];

            return response()->json($data, 401);
        }
    }
}
