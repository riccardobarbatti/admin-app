<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    //get All Users
    public function index()
    {
        //all users classic
        //return User::all();
        //All users with paginate
       // return User::paginate();
        //paginate with role("role":{...})
        //return User::with('role')->paginate();
        //use Resource User and with role
        return UserResource::collection(User::with('role')->paginate());
        //use Resource User and without role
       // return UserResource::collection(User::paginate());

        //return fn() => '------> Hello Users';
    }

    //create user
    public function store(UserCreateRequest $request)
    {
        $user = User::create(
            $request-> only('first_name', 'last_name', 'email', 'role_id')
            +['password' => Hash::make('1234')]
        );
        return response(new UserResource($user), Response::HTTP_CREATED);
    }

    public function show($id)
    {
        //get user from id and role
       // return User::with('role')->find($id);
        //with resource and without role
        //return new UserResource(User::find($id));
        //with role
        return new UserResource(User::with('role')->find($id));
    }


    public function update(UserUpdateRequest $request, $id)
    {
        //update user info
        $user = User::find($id);
        $user->update($request-> only('first_name', 'last_name', 'email', 'role_id'));
        return Response(new UserResource($user), Response::HTTP_ACCEPTED);
    }


    public function destroy($id)
    {
        //delete user from id
        User::destroy($id);
        return \response(null, Response::HTTP_NO_CONTENT);
    }

}
