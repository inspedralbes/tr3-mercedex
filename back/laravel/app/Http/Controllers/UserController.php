<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {

        $credentials = Validator::make(
            $request->all(),
            [
                'email' => 'required|string',
                'password' => 'required|string',
            ],
            [
                'required' => 'El :attribute es obligatorio.',
            ]
        );

        if ($credentials->fails()) {
            return response()->json(['errors' => $credentials->errors()->all()], 400);
        } else {
            $user = User::where('email', $request['email'])->first();
            if (!$user) {
                return response(['message' => 'L\'usuari no existeix'], 400);
            } else if (!Hash::check($request['password'], $user->password)) {
                return response(['message' => 'La contrasenya és incorrecta'], 400);
            } else {
                $token = $user->createToken('Spottunes')->plainTextToken;
                $user->makeHidden(['created_at', 'updated_at', 'email_verified_at']);
                $response = [
                    'user' => $user,
                    'token' => $token,
                ];
                return response()->json(['success' => 'Has iniciat sessió', 'data' => $response], 200);
            }
        }
    }

    public function register(Request $request)

    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'surnames' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
        ], [
            'required' => 'El :attribute es obligatorio.',
            'email' => 'El :attribute debe ser una dirección de correo válida.',
            'unique' => 'El :attribute ya está en uso.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 400);
        }


        $user = User::create([
            'name' => $request->name,
            'surnames' => $request->surnames,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'loginWith' => 'email',
        ]);

        $user->makeHidden(['created_at', 'updated_at']);

        $token = $user->createToken('Mercedex')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json(['success' => 'Usuari creat correctament', 'data' => $response], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Token eliminado']);
    }
    
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
