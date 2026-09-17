<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Experience;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        $experiences = [
            [
                'company' => 'PT. Affan Technology Indonesia (Parto.id)',
                'logo' => 'AT',
                'role_id' => 'Backend Laravel Developer',
                'role_en' => 'Backend Laravel Developer',
                'location_id' => 'Ngawi, Jawa Timur, Indonesia 🇮🇩',
                'location_en' => 'Ngawi, Jawa Timur, Indonesia 🇮🇩',
                'period_id' => 'Jul 2025 - Sep 2025',
                'period_en' => 'Jul 2025 - Sep 2025',
                'duration_id' => '3 bulan',
                'duration_en' => '3 months',
                'employment_id' => 'Magang',
                'employment_en' => 'Internship',
                'arrangement_id' => 'Hybrid',
                'arrangement_en' => 'Hybrid',
                'tasks' => [
                    [
                        'id' => 'Memimpin pengembangan sistem absensi internal berbasis RFID.',
                        'en' => 'Led the development of an internal RFID-based attendance system.',
                    ],
                    [
                        'id' => 'Membangun REST API layanan order dengan Laravel dan PostgreSQL.',
                        'en' => 'Built order-service REST APIs with Laravel and PostgreSQL.',
                    ],
                    [
                        'id' => 'Menulis pengujian integrasi dan menyiapkan pipeline deploy.',
                        'en' => 'Wrote integration tests and set up the deployment pipeline.',
                    ],
                ],
                'learnings' => [
                    [
                        'id' => 'Mengasah kemampuan memimpin tim kecil.',
                        'en' => 'Developed leadership skills in a small team.',
                    ],
                    [
                        'id' => 'Pengalaman langsung dengan perangkat IoT.',
                        'en' => 'Gained hands-on experience with IoT devices.',
                    ],
                ],
                'impact' => [
                    [
                        'id' => 'Mendigitalkan proses absensi untuk 80+ karyawan.',
                        'en' => 'Digitalized attendance for 80+ employees.',
                    ],
                    [
                        'id' => 'Waktu proses order turun sekitar 35%.',
                        'en' => 'Cut order processing time by around 35%.',
                    ],
                ],
                'order' => 1,
            ],
            [
                'company' => 'Freelance',
                'logo' => 'FL',
                'role_id' => 'Mobile Developer',
                'role_en' => 'Mobile Developer',
                'location_id' => 'Remote 🇮🇩',
                'location_en' => 'Remote 🇮🇩',
                'period_id' => 'Jan 2024 - Sekarang',
                'period_en' => 'Jan 2024 - Present',
                'duration_id' => '2 tahun',
                'duration_en' => '2 years',
                'employment_id' => 'Paruh waktu',
                'employment_en' => 'Part-time',
                'arrangement_id' => 'Remote',
                'arrangement_en' => 'Remote',
                'tasks' => [
                    [
                        'id' => 'Membangun aplikasi Flutter untuk UMKM lokal.',
                        'en' => 'Built Flutter apps for local small businesses.',
                    ],
                    [
                        'id' => 'Merancang alur UI/UX bersama klien.',
                        'en' => 'Designed UI/UX flows together with clients.',
                    ],
                ],
                'learnings' => [
                    [
                        'id' => 'Komunikasi klien dan manajemen ekspektasi.',
                        'en' => 'Client communication and expectation management.',
                    ],
                    [
                        'id' => 'Optimasi performa aplikasi mobile.',
                        'en' => 'Mobile app performance optimization.',
                    ],
                ],
                'impact' => [
                    [
                        'id' => '8 aplikasi dirilis ke Play Store.',
                        'en' => 'Shipped 8 apps to the Play Store.',
                    ],
                    [
                        'id' => 'Rating rata-rata klien 4.9/5.',
                        'en' => 'Average client rating of 4.9/5.',
                    ],
                ],
                'order' => 2,
            ],
            [
                'company' => 'Himpunan Mahasiswa Sistem Informasi',
                'logo' => 'HM',
                'role_id' => 'Koordinator Divisi Teknologi',
                'role_en' => 'Technology Division Coordinator',
                'location_id' => 'Ngawi, Jawa Timur, Indonesia 🇮🇩',
                'location_en' => 'Ngawi, Jawa Timur, Indonesia 🇮🇩',
                'period_id' => 'Agu 2023 - Jul 2024',
                'period_en' => 'Aug 2023 - Jul 2024',
                'duration_id' => '1 tahun',
                'duration_en' => '1 year',
                'employment_id' => 'Organisasi',
                'employment_en' => 'Organization',
                'arrangement_id' => 'Onsite',
                'arrangement_en' => 'Onsite',
                'tasks' => [
                    [
                        'id' => 'Mengelola situs dan sistem pendaftaran acara himpunan.',
                        'en' => 'Maintained the association website and event registration system.',
                    ],
                    [
                        'id' => 'Mengadakan kelas ngoding untuk mahasiswa baru.',
                        'en' => 'Ran coding classes for first-year students.',
                    ],
                ],
                'learnings' => [
                    [
                        'id' => 'Manajemen proyek dan delegasi tugas.',
                        'en' => 'Project management and task delegation.',
                    ],
                    [
                        'id' => 'Public speaking dan mentoring.',
                        'en' => 'Public speaking and mentoring.',
                    ],
                ],
                'impact' => [
                    [
                        'id' => 'Memimpin tim beranggotakan 5+ mahasiswa.',
                        'en' => 'Successfully led a team of 5+ students.',
                    ],
                    [
                        'id' => '200+ peserta mengikuti kelas ngoding.',
                        'en' => '200+ participants joined the coding classes.',
                    ],
                ],
                'order' => 3,
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::updateOrCreate(
                ['company' => $exp['company'], 'role_id' => $exp['role_id']],
                $exp
            );
        }
    }
}
