<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\addRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ApiException(422, "Validation error", $validator->errors());
        }

        return [
            'data' => [
                'user_token' => User::where(['login' => $request->login])->first()->generateToken()
            ]
        ];
    }

    public function logout()
    {
        Auth::user()->logout();
        return [
            'data' => [
                'message' => 'logout'
            ]
        ];
    }
    public function store(AddRequest $userRequest)
    {
        $user = User::create([
            'photo_file' => $userRequest->photo_file?->store('photos'),
        ] + $userRequest->all()
        );
        return response()->json([
            'data' => [
                'id' => $user->id,
                'status'=>'created'
            ]
        ])->setStatusCode(201, 'Created');
    }
}
