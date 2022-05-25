<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function Auth(AuthRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        // logout others devices
        /*if($request->has('logout_others_device')){
            $user -> tokens()->delete();
        }*/
        $user->tokens()->delete();

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
               'token' => $token    
        ]);

    }

    public function logout()
    {
        auth()->user()->tokens()->delete();  
        
        return response()->json(['success' => true]);
    }

    public function me()
    {
        $user = auth()->user();
        
        return new UserResource($user);
    }
}
