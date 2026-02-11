<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $bendaharaRole = Role::firstOrCreate(['name' => 'bendahara']);
        $penggunRole = Role::firstOrCreate(['name' => 'pengguna']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Masjid',
                'password' => Hash::make('adminmasjid123')
            ]
        );

        $bendahara = User::firstOrCreate(
            ['email' => 'bendahara@gmail.com'],
            [
                'name' => 'Bendahara Masjid',
                'password' => Hash::make('bendaharamasjid123')
            ]
        );

        $pengguna = User::firstOrCreate(
            ['email' => 'pengguna@gmail.com'],
            [
                'name' => 'Pengguna Biasa',
                'password' => Hash::make('pengguna123')
            ]
        );

        $admin->roles()->syncWithoutDetaching([$adminRole->id]);
        $bendahara->roles()->syncWithoutDetaching([$bendaharaRole->id]);
        $pengguna->roles()->syncWithoutDetaching([$penggunRole->id]);
    }

    }

