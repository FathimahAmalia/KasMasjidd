<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InformationComponent;
use App\Models\ContactItem;
use App\Models\RoutineActivity;
use App\Models\LandingSetting;

class InformationPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Landing Settings (Hero & Page Title)
        $settings = [
            'info_page_title' => 'Informasi Masjid',
            'info_page_subtitle' => 'Pusat informasi kegiatan, jadwal, dan layanan untuk jamaah.',
            'profile_description' => 'Masjid ini didirikan dengan tujuan untuk memfasilitasi ibadah umat Islam serta menjadi pusat kegiatan sosial dan pendidikan bagi masyarakat sekitar. Kami berkomitmen untuk memberikan pelayanan terbaik bagi jamaah.',
            'prayer_subuh' => '04:30',
            'prayer_dzuhur' => '12:00',
            'prayer_ashar' => '15:15',
            'prayer_maghrib' => '18:00',
            'prayer_isya' => '19:15',
            'prayer_jumat' => '11:45',
        ];

        foreach ($settings as $key => $value) {
            LandingSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // 2. Information Components
        // Check if exists first to avoid duplicates if run multiple times
        if (InformationComponent::count() == 0) {
            $components = [
                [
                    'title' => 'Tentang Kami',
                    'type' => 'text',
                    'content' => '<div>Masjid kami berdiri sejak tahun 1990 dan terus berkembang melayani umat. Kami memiliki berbagai fasilitas mulai dari ruang sholat utama yang nyaman, perpustakaan, hingga aula serbaguna.</div>',
                    'icon' => 'bi-building',
                    'order' => 1,
                    'is_active' => true,
                ],
                [
                    'title' => 'Visi & Misi',
                    'type' => 'text',
                    'content' => '<ul><li><strong>Visi:</strong> Menjadi pusat peradaban Islam yang rahmatan lil alamin.</li><li><strong>Misi:</strong> Menyelenggarakan ibadah yang khusyuk, pendidikan berkualitas, dan pelayanan sosial yang amanah.</li></ul>',
                    'icon' => 'bi-bullseye',
                    'order' => 2,
                    'is_active' => true,
                ],
                [
                    'title' => 'Jadwal Sholat',
                    'type' => 'prayer_times', // Special widget
                    'content' => null,
                    'icon' => 'bi-clock',
                    'order' => 3,
                    'is_active' => true,
                ],
                [
                    'title' => 'Kegiatan Rutin',
                    'type' => 'routine_activities', // Special widget
                    'content' => null,
                    'icon' => 'bi-calendar-check',
                    'order' => 4,
                    'is_active' => true,
                ],
                 [
                    'title' => 'Hubungi Kami',
                    'type' => 'contact_list', // Special widget
                    'content' => null,
                    'icon' => 'bi-telephone',
                    'order' => 5,
                    'is_active' => true,
                ],
            ];

            foreach ($components as $component) {
                InformationComponent::create($component);
            }
        }

        // 3. Contact Items
        if (ContactItem::count() == 0) {
            $contacts = [
                [
                    'label' => 'WhatsApp Admin',
                    'value' => '+62 812-3456-7890',
                    'icon' => 'bi-whatsapp',
                    'url' => 'https://wa.me/6281234567890',
                    'order' => 1,
                    'is_active' => true,
                ],
                [
                    'label' => 'Email',
                    'value' => 'info@masjid.com',
                    'icon' => 'bi-envelope',
                    'url' => 'mailto:info@masjid.com',
                    'order' => 2,
                    'is_active' => true,
                ],
                [
                    'label' => 'Lokasi',
                    'value' => 'Lihat di Google Maps',
                    'icon' => 'bi-geo-alt',
                    'url' => 'https://maps.google.com',
                    'order' => 3,
                    'is_active' => true,
                ],
            ];

            foreach ($contacts as $contact) {
                ContactItem::create($contact);
            }
        }

        // 4. Routine Activities
        if (RoutineActivity::count() == 0) {
             $activities = [
                [
                    'name' => 'Kajian Rutin Ahad Pagi',
                    'description' => 'Setiap hari Ahad pukul 06.00 WIB bersama Ustadz Fulan.',
                    'icon' => 'bi-book',
                    'is_active' => true,
                ],
                [
                    'name' => 'Taman Pendidikan Al-Quran',
                    'description' => 'Senin - Jumat pukul 16.00 WIB untuk anak-anak.',
                    'icon' => 'bi-people',
                    'is_active' => true,
                ],
                [
                    'name' => 'Jumat Berkah',
                    'description' => 'Pembagian nasi bungkus setiap hari Jumat setelah sholat Jumat.',
                    'icon' => 'bi-gift',
                    'is_active' => true,
                ],
            ];

            foreach ($activities as $activity) {
                RoutineActivity::create($activity);
            }
        }
    }
}
