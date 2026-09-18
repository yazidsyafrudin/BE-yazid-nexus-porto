<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VisitorController extends Controller
{
    /**
     * Record a page visit from client ping.
     */
    public function ping(Request $request)
    {
        $validated = $request->validate([
            'visitor_id' => 'required|string|max:100',
            'page' => 'nullable|string|max:255',
            'referrer' => 'nullable|string|max:500',
            'device' => 'nullable|string|max:50',
            'browser' => 'nullable|string|max:50',
            'os' => 'nullable|string|max:50',
        ]);

        $visitorId = $validated['visitor_id'];
        $page = $validated['page'] ?: '/';
        $referrer = $validated['referrer'] ?? null;

        // Mendeteksi IP & Negara (dukungan reverse proxy / Cloudflare / Railway)
        $ip = $request->header('CF-Connecting-IP')
            ?: ($request->header('X-Forwarded-For')
                ? trim(explode(',', $request->header('X-Forwarded-For'))[0])
                : $request->ip());

        $country = $request->header('CF-IPCountry') ?: 'Indonesia';
        $city = $request->header('CF-IPCity') ?: null;

        // Cegah spam: jika visitor_id yang sama membuka page yang sama dalam 10 menit terakhir, tidak diduplikasi
        $recent = Visitor::where('visitor_id', $visitorId)
            ->where('page', $page)
            ->where('created_at', '>=', Carbon::now()->subMinutes(10))
            ->first();

        if (!$recent) {
            Visitor::create([
                'visitor_id' => $visitorId,
                'ip_address' => $ip,
                'user_agent' => $request->userAgent(),
                'page' => $page,
                'referrer' => $referrer,
                'device' => $validated['device'] ?? $this->detectDevice($request->userAgent()),
                'browser' => $validated['browser'] ?? $this->detectBrowser($request->userAgent()),
                'os' => $validated['os'] ?? $this->detectOS($request->userAgent()),
                'country' => $country,
                'city' => $city,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Visit recorded',
        ]);
    }

    /**
     * Get aggregate statistics for dashboard and UI.
     */
    public function stats(Request $request)
    {
        $totalUnique = Visitor::distinct('visitor_id')->count('visitor_id');
        $totalPageViews = Visitor::count();

        $startThisMonth = Carbon::now()->startOfMonth();
        $startLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endLastMonth = Carbon::now()->subMonth()->endOfMonth();

        $thisMonthVisitors = Visitor::where('created_at', '>=', $startThisMonth)
            ->distinct('visitor_id')
            ->count('visitor_id');

        $lastMonthVisitors = Visitor::whereBetween('created_at', [$startLastMonth, $endLastMonth])
            ->distinct('visitor_id')
            ->count('visitor_id');

        $growth = 0;
        $isPositive = true;
        if ($lastMonthVisitors > 0) {
            $growth = round((($thisMonthVisitors - $lastMonthVisitors) / $lastMonthVisitors) * 100);
            $isPositive = $growth >= 0;
        } else {
            $growth = $thisMonthVisitors > 0 ? 100 : 0;
            $isPositive = true;
        }

        $recentVisitors = Visitor::latest()
            ->take(10)
            ->get(['id', 'visitor_id', 'page', 'referrer', 'device', 'browser', 'os', 'country', 'city', 'created_at']);

        return response()->json([
            'status' => 'success',
            'data' => [
                'total_visitors' => $totalUnique,
                'total_page_views' => $totalPageViews,
                'this_month' => $thisMonthVisitors,
                'last_month' => $lastMonthVisitors,
                'growth_percentage' => abs($growth),
                'is_positive' => $isPositive,
                'recent_visitors' => $recentVisitors,
            ],
        ]);
    }

    private function detectDevice(?string $ua): string
    {
        if (!$ua) return 'Desktop';
        if (preg_match('/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i', $ua)) return 'Tablet';
        if (preg_match('/Mobile|Android|iP(hone|od)|IEMobile|BlackBerry|Kindle/i', $ua)) return 'Mobile';
        return 'Desktop';
    }

    private function detectBrowser(?string $ua): string
    {
        if (!$ua) return 'Browser';
        if (str_contains($ua, 'Edg')) return 'Edge';
        if (str_contains($ua, 'Chrome')) return 'Chrome';
        if (str_contains($ua, 'Safari')) return 'Safari';
        if (str_contains($ua, 'Firefox')) return 'Firefox';
        if (str_contains($ua, 'Opera') || str_contains($ua, 'OPR')) return 'Opera';
        return 'Browser';
    }

    private function detectOS(?string $ua): string
    {
        if (!$ua) return 'OS';
        if (str_contains($ua, 'Windows')) return 'Windows';
        if (str_contains($ua, 'Macintosh') || str_contains($ua, 'Mac OS')) return 'macOS';
        if (str_contains($ua, 'Linux')) return 'Linux';
        if (str_contains($ua, 'Android')) return 'Android';
        if (str_contains($ua, 'iPhone') || str_contains($ua, 'iPad')) return 'iOS';
        return 'OS';
    }
}
