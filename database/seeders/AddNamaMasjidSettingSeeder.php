<?php

namespace Database\Seeders;

use App\Models\LandingSetting;
use Illuminate\Database\Seeder;

class AddNamaMasjidSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LandingSetting::updateOrCreate(
            ['key' => 'nama_masjid'],
            [
                'value' => 'Masjid Nabawi',
                'type' => 'text',
                'label' => 'Nama Masjid'
            ]
        );
    }
}
