<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SanctumController extends Controller
{
    /**
     * Make the login and generate the token.
     */
    public function login(Request $request): JsonResponse {
        $credencials = $request->only(['email', 'password']);
        if (Auth::attempt($credencials) === false) {
            return response()->json('Unauthorized', 401);
        }
        $user = Auth::user();
        $user->tokens()->delete();
        $token = $user->createToken('token', ['books:store,delete']);

        return response()->json($token->plainTextToken);
    }
}
