<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievement;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $achievements = [
            [
                'title' => 'Backend Developer Internship - Parto.id',
                'issuer' => 'Affan Technology Indonesia',
                'date' => 'Juli 2025',
                'credential_url' => 'https://parto.id',
                'description_id' => 'Sertifikat kelulusan magang sebagai Backend Laravel Developer.',
                'description_en' => 'Internship completion certificate as Backend Laravel Developer.',
            ],
            [
                'title' => 'Belajar Membuat Aplikasi Flutter',
                'issuer' => 'Dicoding Indonesia',
                'date' => 'Maret 2025',
                'credential_url' => 'https://dicoding.com',
                'description_id' => 'Sertifikat kompetensi pengembangan aplikasi Flutter lintas platform.',
                'description_en' => 'Competency certificate for cross-platform Flutter development.',
            ],
            [
                'title' => 'Petunjuk Pro: Freelance untuk Developer',
                'issuer' => 'Build With Angga',
                'date' => 'Desember 2024',
                'credential_url' => 'https://buildwithangga.com',
                'description_id' => 'Kelas profesional mengenai ekosistem dan manajemen proyek freelance.',
                'description_en' => 'Professional course on freelance ecosystem and project management.',
            ],
            [
                'title' => 'Laravel Backend Fundamentals',
                'issuer' => 'Dicoding Indonesia',
                'date' => 'Agustus 2024',
                'credential_url' => 'https://dicoding.com',
                'description_id' => 'Sertifikat keahlian backend arsitektur bersih Laravel REST API.',
                'description_en' => 'Certificate in clean architecture Laravel REST API backend.',
            ],
            [
                'title' => 'Juara 2 Lomba Karya Tulis Teknologi',
                'issuer' => 'Universitas Jambi',
                'date' => 'Mei 2024',
                'credential_url' => '#',
                'description_id' => 'Penghargaan karya tulis ilmiah bidang inovasi teknologi informasi.',
                'description_en' => 'Scientific paper competition award in IT innovation.',
            ],
            [
                'title' => 'Cloud Practitioner Essentials',
                'issuer' => 'AWS Educate',
                'date' => 'November 2023',
                'credential_url' => 'https://aws.amazon.com',
                'description_id' => 'Dasar-dasar infrastruktur cloud Amazon Web Services.',
                'description_en' => 'Fundamentals of Amazon Web Services cloud infrastructure.',
            ],
        ];

        foreach ($achievements as $ach) {
            Achievement::updateOrCreate(['title' => $ach['title']], $ach);
        }
    }
}
