<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'slug' => 'pos-parto',
                'title' => 'POS Parto.id',
                'image' => 'https://raw.githubusercontent.com/yazidsyafrudin/yazid-nexus-portal/main/src/assets/project-parto.jpg',
                'featured' => true,
                'type' => 'web',
                'category' => 'internship',
                'description_id' => 'Platform pemesanan dan manajemen order berbasis web untuk UMKM, lengkap dengan laporan penjualan realtime.',
                'description_en' => 'Web-based ordering and order management platform for small businesses, with realtime sales reporting.',
                'stack' => ['Next.js', 'TypeScript', 'PostgreSQL', 'Supabase'],
                'reactions' => [
                    ['emoji' => '🌐', 'count' => 3],
                    ['emoji' => '😃', 'count' => 3],
                    ['emoji' => '🤨', 'count' => 2],
                ],
            ],
            [
                'slug' => 'tnks-kerinci',
                'title' => 'TNKS Gunung Kerinci',
                'image' => 'https://raw.githubusercontent.com/yazidsyafrudin/yazid-nexus-portal/main/src/assets/project-kerinci.jpg',
                'featured' => true,
                'type' => 'mobile',
                'category' => 'competition',
                'description_id' => 'Aplikasi pendamping pendaki dengan rute offline, grafik elevasi, cuaca, dan penanda titik keselamatan.',
                'description_en' => 'Hiking companion app with offline routes, elevation charts, weather, and safety checkpoints.',
                'stack' => ['Flutter', 'Firebase', 'Mapbox'],
                'reactions' => [
                    ['emoji' => '🌐', 'count' => 5],
                    ['emoji' => '😃', 'count' => 4],
                    ['emoji' => '🤨', 'count' => 1],
                ],
            ],
            [
                'slug' => 'agrosense',
                'title' => 'AgroSense IoT',
                'image' => 'https://raw.githubusercontent.com/yazidsyafrudin/yazid-nexus-portal/main/src/assets/project-agrosense.jpg',
                'featured' => true,
                'type' => 'web',
                'category' => 'personal',
                'description_id' => 'Sistem monitoring kelembapan tanah dan nutrisi secara realtime dari jaringan sensor lapangan.',
                'description_en' => 'Realtime soil moisture and nutrient monitoring from a field sensor network.',
                'stack' => ['Laravel', 'MQTT', 'TimescaleDB', 'React'],
                'reactions' => [
                    ['emoji' => '🌐', 'count' => 2],
                    ['emoji' => '😃', 'count' => 3],
                    ['emoji' => '🚀', 'count' => 4],
                ],
            ],
            [
                'slug' => 'rfid-attendance',
                'title' => 'RFID Attendance',
                'image' => 'https://raw.githubusercontent.com/yazidsyafrudin/yazid-nexus-portal/main/src/assets/project-rfid.jpg',
                'featured' => true,
                'type' => 'web',
                'category' => 'internship',
                'description_id' => 'Sistem absensi internal berbasis RFID yang menulis langsung ke dasbor kehadiran live.',
                'description_en' => 'Internal RFID-based attendance system writing straight into a live attendance dashboard.',
                'stack' => ['Laravel', 'React', 'PostgreSQL'],
                'reactions' => [
                    ['emoji' => '🌐', 'count' => 4],
                    ['emoji' => '😃', 'count' => 2],
                ],
            ],
            [
                'slug' => 'warung-pos',
                'title' => 'Warung POS',
                'image' => 'https://raw.githubusercontent.com/yazidsyafrudin/yazid-nexus-portal/main/src/assets/project-parto.jpg',
                'featured' => false,
                'type' => 'mobile',
                'category' => 'freelance',
                'description_id' => 'Aplikasi kasir sederhana untuk warung dengan mode offline dan cetak struk bluetooth.',
                'description_en' => 'A simple point-of-sale app for small shops with offline mode and Bluetooth receipt printing.',
                'stack' => ['Flutter', 'SQLite'],
                'reactions' => [
                    ['emoji' => '😃', 'count' => 6],
                    ['emoji' => '🤨', 'count' => 1],
                ],
            ],
            [
                'slug' => 'kampus-kita',
                'title' => 'Kampus Kita',
                'image' => 'https://raw.githubusercontent.com/yazidsyafrudin/yazid-nexus-portal/main/src/assets/project-agrosense.jpg',
                'featured' => false,
                'type' => 'web',
                'category' => 'personal',
                'description_id' => 'Portal informasi kegiatan kampus dengan jadwal, pengumuman, dan pendaftaran acara.',
                'description_en' => 'Campus activity portal with schedules, announcements, and event registration.',
                'stack' => ['React', 'Node.js', 'Redis'],
                'reactions' => [
                    ['emoji' => '🌐', 'count' => 1],
                    ['emoji' => '😃', 'count' => 2],
                ],
            ],
        ];

        foreach ($projects as $proj) {
            $proj['stack'] = json_encode($proj['stack']);
            $proj['reactions'] = json_encode($proj['reactions']);
            Project::updateOrCreate(['slug' => $proj['slug']], $proj);
        }
    }
}
