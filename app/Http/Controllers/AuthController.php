<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * login API
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'login' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
//            return $this->responseFail(422, $validator->messages());
            return response()->json($validator->messages(), 422);
        }
        $credentials = $request->only(['login', 'password']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role_id == User::ROLE_ADMIN) {
                $success['token'] = $user->createToken('avior', ['admin'])->accessToken;
            } elseif ($user->role_id == User::ROLE_OWNER) {
                $success['token'] = $user->createToken('avior', ['owner'])->accessToken;
            } elseif ($user->role_id == User::ROLE_CUSTOMER) {
                $success['token'] = $user->createToken('avior', ['customer'])->accessToken;
            }
            return response()->json([
                'user' => $user,
                'token' => $success['token']
            ]);
        } else {
            return response()->json('Unauthenticated', 422);
        }
    }

    /**
     * register API
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'role_id' => 'required|numeric|min:2|max:3',
            'login' => 'required|unique:users',
            'full_name' => 'required',
            'phone' => 'required|numeric',
            'password' => 'required|min:6',
            'verify_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return $this->responseFail(422, $validator->messages());
        }

        if ($request->role_id == 2) {
            $tokenRole = 'owner';
        } elseif ($request->role_id == 3) {
            $tokenRole = 'customer';
        } else {
            return response()->json('Registration failed', 422);
        }
        $request['password'] = bcrypt($request->password);
        $user = User::query()->create($request->all());
//        $success['name'] = $user->name;
        $success['token'] = $user->createToken('avior', [$tokenRole])->accessToken;
        return $this->responseSuccess([
            'user' => $user,
            'token' => $success['token']
        ]);
    }
}
