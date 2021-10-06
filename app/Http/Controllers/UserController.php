<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    //
    /* El método authenticate intenta iniciar la sesión del usuario y genera y token de autorización si el 
    usuario se encuentra en la base de datos. El método lanza un error si no se encuentra el usuario en la base de 
    datos o si se produce alguna excepción. */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciales Invalidas'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'No se pudo craer el token'], 500);
        }
        return response()->json(compact('token'));
    }

    /* El método register intenta valida los datos de un nuevo usuario y lo crea en la base de datos y devuelve un 
token de acceso, de esta manera el usuario creado puede iniciar acceder de manera inmediata sin necesidad 
de iniciar sesión. */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user', 'token'), 201);
    }

    /* El método getAuthenticatedUser retorna el objeto del usuario basado en el token de autorización 
recibido. */
    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['Usuario no encontrado'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(
                ['Token expirado'],


            );
        } catch (TokenInvalidException $e) {
            return response()->json(['Token Invalido']);
        } catch (JWTException $e) {
            return response()->json(['token_absent']);
        }
        return response()->json(compact('user'));
    }
}
