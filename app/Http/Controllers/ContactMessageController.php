<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:3000',
        ]);

        $message = \App\Models\ContactMessage::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Pesan Anda berhasil terkirim. Terima kasih telah menghubungi saya!',
            'data' => $message,
        ], 201);
    }
}
