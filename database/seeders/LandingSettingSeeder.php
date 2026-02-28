<?php

namespace Database\Seeders;

use App\Models\LandingSetting;
use Illuminate\Database\Seeder;

class LandingSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Hero Section
            [
                'key' => 'hero_title',
                'value' => 'Wujudkan Amal Jariyah Bersama Masjid Nabawi',
                'type' => 'text',
                'label' => 'Judul Hero',
            ],
            [
                'key' => 'hero_description',
                'value' => 'Platform digital pengelolaan keuangan masjid yang transparan. Salurkan donasi Anda dengan mudah, aman, dan barokah untuk kemaslahatan umat.',
                'type' => 'textarea',
                'label' => 'Deskripsi Hero',
            ],
            
            // About Section
            [
                'key' => 'about_title',
                'value' => 'Mengelola Amanah dengan Profesional & Modern',
                'type' => 'text',
                'label' => 'Judul Tentang Kami',
            ],
            [
                'key' => 'about_description',
                'value' => 'Masjid Nabawi hadir dengan sistem manajemen keuangan digital yang memungkinkan seluruh jamaah memantau arus kas secara realtime, transparan, dan akuntabel.',
                'type' => 'textarea',
                'label' => 'Deskripsi Tentang Kami',
            ],
            [
                'key' => 'about_image',
                'value' => 'https://images.unsplash.com/photo-1542385151-efd9000785a0?q=80&w=1978&auto=format&fit=crop',
                'type' => 'image',
                'label' => 'Gambar Tentang Kami',
            ],

            // Contact Section
            [
                'key' => 'contact_address',
                'value' => 'Jl. Masjid Nabawi No. 123, Komplek Surga Firdaus, Kota Madani, Indonesia',
                'type' => 'text',
                'label' => 'Alamat',
            ],
            [
                'key' => 'contact_phone',
                'value' => '+62 812-3456-7890',
                'type' => 'text',
                'label' => 'Nomor Telepon',
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@masjidnabawi.com',
                'type' => 'text',
                'label' => 'Email',
            ],
            [
                'key' => 'contact_google_maps_link',
                'value' => 'https://maps.google.com',
                'type' => 'text',
                'label' => 'Link Google Maps',
            ],

            // Social Media
            [
                'key' => 'social_facebook',
                'value' => '',
                'type' => 'text',
                'label' => 'Link Facebook',
            ],
            [
                'key' => 'social_instagram',
                'value' => '',
                'type' => 'text',
                'label' => 'Link Instagram',
            ],
            [
                'key' => 'social_youtube',
                'value' => '',
                'type' => 'text',
                'label' => 'Link Youtube',
            ],

            // Information Page - Profile
            [
                'key' => 'profile_description',
                'value' => 'Masjid Nabawi adalah pusat peradaban dan ibadah yang berkomitmen melayani umat dengan fasilitas modern dan manajemen yang transparan. Kami hadir tidak hanya sebagai tempat sholat, tetapi sebagai pusat pemberdayaan masyarakat.',
                'type' => 'textarea',
                'label' => 'Deskripsi Profil Lengkap',
            ],

            // Information Page - Prayer Times
            [
                'key' => 'prayer_subuh',
                'value' => '04:30',
                'type' => 'text',
                'label' => 'Jadwal Subuh',
            ],
            [
                'key' => 'prayer_dzuhur',
                'value' => '12:00',
                'type' => 'text',
                'label' => 'Jadwal Dzuhur',
            ],
            [
                'key' => 'prayer_ashar',
                'value' => '15:15',
                'type' => 'text',
                'label' => 'Jadwal Ashar',
            ],
            [
                'key' => 'prayer_maghrib',
                'value' => '18:05',
                'type' => 'text',
                'label' => 'Jadwal Maghrib',
            ],
            [
                'key' => 'prayer_isya',
                'value' => '19:30',
                'type' => 'text',
                'label' => 'Jadwal Isya',
            ],
        ];

        foreach ($settings as $setting) {
            LandingSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
