<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        // Default CV URL fallback
        if (!isset($settings['cv_url']) || empty($settings['cv_url'])) {
            $settings['cv_url'] = '/cv-yazid.pdf';
        }

        return response()->json([
            'status' => 'success',
            'data' => $settings,
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'cv_url' => 'nullable|string',
            'settings' => 'nullable|array',
        ]);

        if ($request->has('cv_url')) {
            Setting::set('cv_url', $request->input('cv_url'));
        }

        if ($request->has('settings') && is_array($request->input('settings'))) {
            foreach ($request->input('settings') as $k => $v) {
                Setting::set($k, $v);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Pengaturan berhasil diperbarui',
            'data' => Setting::all()->pluck('value', 'key')->toArray(),
        ]);
    }

    public function uploadCv(Request $request)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:15360', // max 15MB PDF
        ]);

        $file = $request->file('cv');
        $fileName = 'CV_Yazid_Syafrudin_' . time() . '.pdf';
        $path = $file->storeAs('cv', $fileName, 'public');

        $url = asset('storage/' . $path);
        Setting::set('cv_url', $url);

        return response()->json([
            'status' => 'success',
            'message' => 'File CV berhasil diunggah',
            'cv_url' => $url,
        ]);
    }

    public function downloadCv()
    {
        $cvUrl = Setting::get('cv_url', '/cv-yazid.pdf');
        
        // If it starts with http, redirect to it
        if (str_starts_with($cvUrl, 'http')) {
            return redirect()->away($cvUrl);
        }

        return redirect($cvUrl);
    }
}
