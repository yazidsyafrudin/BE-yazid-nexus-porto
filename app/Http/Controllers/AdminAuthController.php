<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'pin' => 'required|string',
        ]);

        $adminPin = env('ADMIN_SECRET_PIN', '123456');

        if ($request->pin === $adminPin) {
            return response()->json([
                'status' => 'success',
                'token' => md5($adminPin . '_yazid_nexus_token'),
                'message' => 'Login berhasil'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'PIN Admin salah!'
        ], 401);
    }
}
