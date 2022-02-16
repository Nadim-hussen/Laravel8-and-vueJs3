<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;



class LoginController extends Controller
{
    public function register(Request $request)
    {
        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'phone'=> $request->input('phone')
        ]);
    }
    public function login(Request $request)
    {
        // if (!Auth::attempt($request->only('email', 'password'))) {
        //     return response([
        //         'message' => 'Invalid credentials!'
        //     ], Response::HTTP_UNAUTHORIZED);
        // }

        $data = User::where('email', $request->email)->first();
        if (!$data ||  $request->password != $data->password) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        // $user = Auth::user();

        $token = $data->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token);
        // cookie('email',$data->email,60 * 24);

        return response([
            'message' => $token
        ])->withCookie($cookie);
    }

    public function user(Request $request)
    {
        // return \response([
        //     'message' =>$request->cookie('jwt')
        // ]);
        // $cookie = $request->cookie('email');
        // if($request->cookie('email')){
        //     return redirect('http://127.0.0.1:8000/login');
        // }else{
        //     return false;
        // }

        if(!cookie('jwt')){
            return false;
        }
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');

        // return response([
        //     'message' => 'Success'
        // ]);
        return response([
            'message' => $cookie
        ])->withCookie($cookie);
    }
}