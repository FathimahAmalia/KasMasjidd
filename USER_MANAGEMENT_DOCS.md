# Fitur Manajemen Pengguna - Dokumentasi

## Deskripsi
Menu "Pengaturan" telah difungsikan untuk mengelola pengguna dengan role **Admin** dan **Bendahara Masjid**. Fitur ini hanya dapat diakses oleh pengguna yang memiliki role **admin**.

## Akses Kontrol

### Siapa yang bisa mengakses?
- **Hanya Admin** - Pengguna dengan role "admin"

### Fitur yang tersedia:
1. **Melihat daftar pengguna** - View semua pengguna di sistem
2. **Tambah pengguna baru** - Membuat akun pengguna baru dengan role yang dipilih
3. **Edit pengguna** - Mengubah data pengguna dan role mereka
4. **Hapus pengguna** - Menghapus akun pengguna (tidak bisa menghapus diri sendiri)

## Menu Navigation

Struktur menu di sidebar:
```
Lainnya
└── Pengaturan (Hanya terlihat untuk Admin)
    └── Manajemen Pengguna
```

## Routes yang Tersedia

```
GET    /users              - Daftar semua pengguna
GET    /users/create       - Form tambah pengguna
POST   /users              - Simpan pengguna baru
GET    /users/{id}/edit    - Form edit pengguna
PUT    /users/{id}         - Update data pengguna
DELETE /users/{id}         - Hapus pengguna
```

## Fitur Keamanan

1. **Role-based Access Control**: Hanya admin yang bisa mengakses menu dan fitur ini
2. **Validasi Email Unik**: Email pengguna harus unik dalam sistem
3. **Password Hashing**: Password dienkripsi sebelum disimpan
4. **Proteksi Diri Sendiri**: Admin tidak bisa menghapus akun mereka sendiri
5. **Validasi Role**: Pengguna baru harus memiliki minimal satu role

## Form Validasi

### Tambah Pengguna
- **Nama**: Wajib, teks, max 255 karakter
- **Email**: Wajib, format email valid, harus unik
- **Password**: Wajib, minimal 6 karakter, harus dikonfirmasi
- **Role**: Wajib, pilih minimal satu role

### Edit Pengguna
- **Nama**: Wajib, teks, max 255 karakter
- **Email**: Wajib, format email valid, harus unik
- **Password**: Opsional, jika diisi minimal 6 karakter, harus dikonfirmasi
- **Role**: Wajib, pilih minimal satu role

## Pesan Error

Jika pengguna non-admin mencoba mengakses fitur ini, akan ditampilkan pesan:
- "Anda tidak memiliki akses untuk menambah pengguna"
- "Anda tidak memiliki akses untuk melihat daftar pengguna"
- "Anda tidak memiliki akses untuk mengedit pengguna"
- "Anda tidak memiliki akses untuk menghapus pengguna"

## Tips Penggunaan

1. **Tambah Role Baru**: Pastikan role (seperti "bendahara" dan "admin") sudah ada di database sebelum menambah pengguna
2. **Assign Multiple Roles**: Satu pengguna bisa memiliki lebih dari satu role
3. **Edit Password**: Saat edit, password bisa dikosongkan jika tidak ingin mengubahnya
4. **Konfirmasi Aksi**: Saat menghapus pengguna, sistem akan meminta konfirmasi dengan SweetAlert2

## File-file yang Ditambahkan

```
app/Http/Controllers/UserController.php     - Controller untuk manajemen pengguna
resources/views/users/index.blade.php       - View daftar pengguna
resources/views/users/create.blade.php      - View form tambah pengguna
resources/views/users/edit.blade.php        - View form edit pengguna
routes/web.php                              - Routes (sudah ditambahkan)
resources/views/layouts/app.blade.php       - Menu layout (sudah diupdate)
```

## Database Requirements

Pastikan tabel berikut sudah ada di database:
- `users` - Tabel pengguna
- `roles` - Tabel role/peran
- `role_user` - Tabel pivot untuk relasi many-to-many

Setiap role (admin, bendahara) harus sudah diinput ke tabel `roles`.

