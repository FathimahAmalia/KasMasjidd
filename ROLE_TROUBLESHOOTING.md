# Troubleshooting Menu Settings Tidak Muncul dengan Benar

## Solusi Cepat

Jika menu "Pengaturan" masih muncul untuk pengguna non-admin, jalankan perintah berikut untuk reset database dengan seeder:

```bash
php artisan migrate:fresh --seed
```

Ini akan:
1. Menghapus semua tabel
2. Membuat tabel baru dari migrations
3. Menjalankan seeder untuk membuat user test

## User Test yang Dibuat

Setelah menjalankan seeder, Anda akan memiliki 3 user:

| Email | Password | Role | Dapat Menu Settings? |
|-------|----------|------|----------------------|
| admin@gmail.com | adminmasjid123 | admin | ✅ YA |
| bendahara@gmail.com | bendaharamasjid123 | bendahara | ❌ TIDAK |
| pengguna@gmail.com | pengguna123 | pengguna | ❌ TIDAK |

## Cara Manual Mengecek Role di Database

Jika ingin mengecek role pengguna langsung dari database:

1. Buka MySQL Workbench atau tools database Anda
2. Query untuk melihat user dan role:

```sql
-- Melihat semua pengguna dan role mereka
SELECT u.name, u.email, GROUP_CONCAT(r.name) as roles
FROM users u
LEFT JOIN role_user ru ON u.id = ru.user_id
LEFT JOIN roles r ON ru.role_id = r.id
GROUP BY u.id;
```

3. Hasil yang benar harus menunjukkan:
   - admin@gmail.com => admin
   - bendahara@gmail.com => bendahara
   - pengguna@gmail.com => pengguna

## Cara Mengubah Role Pengguna

Jika Anda sudah menambahkan pengguna via fitur "Manajemen Pengguna" tetapi role-nya salah:

### Via Fitur UI (Manajemen Pengguna)
1. Login sebagai admin
2. Buka menu Pengaturan > Manajemen Pengguna
3. Klik edit pada pengguna yang ingin diubah
4. Ubah/tambahkan role yang diperlukan
5. Simpan

### Via Direct SQL Query
```sql
-- Tambah role admin ke user dengan email tertentu
INSERT INTO role_user (user_id, role_id, created_at, updated_at)
SELECT u.id, r.id, NOW(), NOW()
FROM users u, roles r
WHERE u.email = 'pengguna@gmail.com' AND r.name = 'admin';
```

```sql
-- Hapus role tertentu dari user
DELETE ru FROM role_user ru
JOIN users u ON ru.user_id = u.id
JOIN roles r ON ru.role_id = r.id
WHERE u.email = 'pengguna@gmail.com' AND r.name = 'pengguna';
```

## Verifikasi Kode

Pengecekan role di layout menggunakan:

```php
@php
    $hasAdminRole = false;
    if(Auth::check()) {
        $userRoles = Auth::user()->roles()->pluck('name')->toArray();
        $hasAdminRole = in_array('admin', $userRoles);
    }
@endphp

@if($hasAdminRole)
    <!-- Menu Pengaturan hanya muncul di sini -->
@endif
```

## Periksa Setelah Perbaikan

1. Logout dari semua akun
2. Hapus browser cache/cookies (Ctrl+Shift+Delete)
3. Login dengan akun test yang berbeda dan verifikasi:
   - **admin@gmail.com**: Menu Pengaturan harus muncul ✅
   - **bendahara@gmail.com**: Menu Pengaturan TIDAK boleh muncul ❌
   - **pengguna@gmail.com**: Menu Pengaturan TIDAK boleh muncul ❌

