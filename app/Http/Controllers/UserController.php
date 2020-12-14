<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exception\JWTException;

class UserController extends Controller
{
    public function login(Request $request)
    {
    	$credentials = $request->only('email', 'password');

    	try {
    		if (! $token = JWTAuth::attempt($credentials))
    		{
    			return response()->json(['error' => 'invalid_credentials'], 400);
    		}
    	} catch (JWTException $e) {
    		return response()->json(['error' => 'could_not_creatre_token', 500]);
    	}
    	return response()->json(compact('token'));
    }
    public function register(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'name' => 'required|string|max:255',
    		'email' => 'required|string|email|max:255|unique:users',
    		'password' => 'required|string|min:6|confirmed',
    		'type' => 'required|integer',
    	]);
    	if ($validator->fails()) {
    		return response()->json($validator->errors()->toJson(), 400);
    	}
    	$user = User::create([
    		'name' => $request->get('name'),
    		'email' => $request->get('email'),
    		'password' => Hash::make($request->get('password')),
    		'type' => $request->get('type'),
    	]);

    	$token = JWTAuth::fromUser($user);

    	return response()->json(compact('user', 'token'),201);
    }
    public function getAuthenticatedUser()
    {
    	try
    	{
    		if (! $user = JWTAuth::perseToken()->autenticate()){
    			return response()->json(['user_not_found'], 404);
    		}
    	}
    	catch (Tymon\JWTAuth\Exception\TokenExpiredException $e)
    	{
    		return response()->json(['token_expired'], $e->getStatusCode());
    	}
    	catch (Tymon\JWTAuth\Exception\TokenInvalidException $e)
    	{
    		return response()->json(['token_invalid'], $e->getStatusCode());
    	}
    	catch (Tymon\JWTAuth\Exception\JWTException $e)
    	{
    		return response()->json(['token_absent'], $e->getStatusCode());
    	}
    	return response()->json(compact('user'));
    }
}
