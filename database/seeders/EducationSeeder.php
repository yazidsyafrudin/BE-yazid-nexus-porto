<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Education;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        $educations = [
            [
                'school' => 'Universitas Jambi',
                'logo' => 'UJ',
                'degree_id' => 'Sarjana (S.Kom)',
                'degree_en' => "Bachelor's degree",
                'major_id' => 'Sistem Informasi',
                'major_en' => 'Information Systems',
                'gpa' => '3.80/4.00',
                'period' => '2022 - 2026',
                'location_id' => 'Ngawi, Jawa Timur, Indonesia 🇮🇩',
                'location_en' => 'Ngawi, Jawa Timur, Indonesia 🇮🇩',
                'order' => 1,
            ],
            [
                'school' => 'SMAN 1 Tanjung Jabung Barat',
                'logo' => 'SM',
                'degree_id' => 'SMA',
                'degree_en' => 'Senior High School',
                'major_id' => 'IPA',
                'major_en' => 'Science',
                'gpa' => null,
                'period' => '2019 - 2022',
                'location_id' => 'Tanjung Jabung Barat, Indonesia 🇮🇩',
                'location_en' => 'Tanjung Jabung Barat, Indonesia 🇮🇩',
                'order' => 2,
            ],
        ];

        foreach ($educations as $edu) {
            Education::updateOrCreate(
                ['school' => $edu['school'], 'degree_id' => $edu['degree_id']],
                $edu
            );
        }
    }
}
