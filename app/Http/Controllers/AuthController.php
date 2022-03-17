<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use function Psr\Log\error;

class AuthController extends Controller
{
    //--------------------------------------
    //register
    //--------------------------------------
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => 2
        ]);

        return response(new UserResource($user), Response::HTTP_CREATED);
    }

    //--------------------------------------
    //login
    //--------------------------------------
    public function login(Request $request)
    {
        //check request email & passwd
        if (!Auth::attempt($request->only('email', 'password'))) {
           return \response([
           'error' => 'Invalid credentials!'
           ], Response::HTTP_UNAUTHORIZED);
          }

          /** @var User $user $ */
          //create token
          $user = Auth::user();
          $jwt = $user->createToken('token')->plainTextToken;
          //made cookie jwt - 1day
          $cookie = cookie('jwt', $jwt, 60 * 24);
          //set JWT to cookie
          return \response([
              'jwt' => $jwt
          ])->withCookie($cookie);

    }//end login

    public function user(Request $request)
    {
        $user = $request->user();
        return new UserResource($user->load('role'));
    }

    //----------
    //Logout
    //--------------
    public function logout(){
        $cookie = \Cookie::forget('jwt');
        return \response([
            'message' => 'success logout'
        ])->withCookie($cookie);
    }//end logout

    //update info user
    public function updateInfo(UpdateInfoRequest $request){
        //update user info
        $user = $request->user();
        $user->update($request-> only('first_name', 'last_name', 'email'));
        return Response(new UserResource($user), Response::HTTP_ACCEPTED);


    }
    //update password user
    public function updatePassword(UpdatePasswordRequest $request){
        //update user info
        $user = $request->user();
        $user->update([
            'password' => Hash::make($request->input('password'))
        ]);
        return Response(new UserResource($user), Response::HTTP_ACCEPTED);


    }
}
