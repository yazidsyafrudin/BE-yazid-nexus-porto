<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestbookController extends Controller
{
    public function index()
    {
        $messages = \App\Models\Guestbook::latest()->take(100)->get();

        return response()->json([
            'status' => 'success',
            'data' => $messages,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'avatar' => 'nullable|string|max:500',
            'location' => 'nullable|string|max:100',
            'category' => 'required|string|in:Pesan,Saran,Kesan',
            'message' => 'required|string|max:2000',
        ]);

        if (empty($validated['avatar'])) {
            $nameForSeed = urlencode($validated['name']);
            $validated['avatar'] = "https://api.dicebear.com/7.x/bottts/svg?seed={$nameForSeed}";
        }

        if (empty($validated['location'])) {
            $validated['location'] = 'Indonesia';
        }

        $guestbook = \App\Models\Guestbook::create([
            'name' => $validated['name'],
            'avatar' => $validated['avatar'],
            'location' => $validated['location'],
            'category' => $validated['category'],
            'message' => $validated['message'],
            'likes' => 0,
            'is_pro' => false,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Pesan berhasil ditambahkan ke buku tamu!',
            'data' => $guestbook,
        ], 201);
    }

    public function like($id)
    {
        $guestbook = \App\Models\Guestbook::findOrFail($id);
        $guestbook->increment('likes');

        return response()->json([
            'status' => 'success',
            'likes' => $guestbook->likes,
        ]);
    }
}
