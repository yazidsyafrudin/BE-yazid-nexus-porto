<?php

namespace App\Http\Controllers;

use App\Models\Guestbook;
use Illuminate\Http\Request;

class GuestbookController extends Controller
{
    public function index()
    {
        // Ambil semua pesan utama (bukan balasan) beserta daftar balasannya
        $messages = Guestbook::with('replies')
            ->whereNull('parent_id')
            ->latest()
            ->take(100)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $messages,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:guestbooks,id',
            'name' => 'required|string|max:100',
            'avatar' => 'nullable|string|max:500',
            'location' => 'nullable|string|max:100',
            'category' => 'nullable|string|in:Pesan,Saran,Kesan',
            'message' => 'required|string|max:2000',
        ]);

        $parentId = $validated['parent_id'] ?? null;
        $category = $validated['category'] ?? null;

        // Jika balasan dan category tidak diisi, warisi kategori dari pesan induk
        if ($parentId && empty($category)) {
            $parent = Guestbook::find($parentId);
            $category = $parent ? $parent->category : 'Pesan';
        } elseif (empty($category)) {
            $category = 'Pesan';
        }

        if (empty($validated['avatar'])) {
            $nameForSeed = urlencode($validated['name']);
            $validated['avatar'] = "https://api.dicebear.com/7.x/bottts/svg?seed={$nameForSeed}";
        }

        if (empty($validated['location'])) {
            $validated['location'] = 'Indonesia';
        }

        // Deteksi jika author adalah Yazid Syafrudin
        $isAuthor = strcasecmp(trim($validated['name']), 'Yazid Syafrudin') === 0;

        $guestbook = Guestbook::create([
            'parent_id' => $parentId,
            'name' => $validated['name'],
            'avatar' => $validated['avatar'],
            'location' => $validated['location'],
            'category' => $category,
            'message' => $validated['message'],
            'likes' => 0,
            'is_pro' => $isAuthor || ($request->boolean('is_pro')),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => $parentId ? 'Balasan berhasil dikirim!' : 'Pesan berhasil ditambahkan ke buku tamu!',
            'data' => $guestbook,
        ], 201);
    }

    public function like($id)
    {
        $guestbook = Guestbook::findOrFail($id);
        $guestbook->increment('likes');

        return response()->json([
            'status' => 'success',
            'likes' => $guestbook->likes,
        ]);
    }
}
