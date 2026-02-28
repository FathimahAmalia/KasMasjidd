@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Pengaturan Web</h6>
                </div>
                <div class="card-body">
                    
                    @if(session('success'))
                        <div class="alert alert-success text-white mb-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs mb-4" id="settingsTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab">Umum & Hero</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button" role="tab">Tentang (Home)</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="visimisi-tab" data-bs-toggle="tab" data-bs-target="#visimisi" type="button" role="tab">Visi & Misi</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">Jadwal Sholat</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="activities-tab" data-bs-toggle="tab" data-bs-target="#activities" type="button" role="tab">Kegiatan Rutin</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="social-tab" data-bs-toggle="tab" data-bs-target="#social" type="button" role="tab">Footer & Sosmed</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="settingsTabContent">
                         
                        <!-- General & Hero Tab -->
                        <div class="tab-pane fade show active" id="general" role="tabpanel">
                            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <h6 class="mb-3 text-primary text-uppercase text-xs font-weight-bolder opacity-7">Hero Section (Halaman Depan)</h6>
                                <div class="mb-3">
                                    <label class="form-label">Nama Masjid (Navbar)</label>
                                    <input type="text" name="nama_masjid" class="form-control" value="{{ $settings['nama_masjid'] ?? '' }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Judul Utama</label>
                                    <input type="text" name="hero_title" class="form-control" value="{{ $settings['hero_title'] ?? '' }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Singkat</label>
                                    <textarea name="hero_description" class="form-control" rows="3">{{ $settings['hero_description'] ?? '' }}</textarea>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-2"></i>Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>

                        <!-- About Tab -->
                        <div class="tab-pane fade" id="about" role="tabpanel">
                            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <h6 class="mb-3 text-primary text-uppercase text-xs font-weight-bolder opacity-7">Tentang Kami (Halaman Depan)</h6>
                                <div class="mb-3">
                                    <label class="form-label">Judul Seksi</label>
                                    <input type="text" name="about_title" class="form-control" value="{{ $settings['about_title'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea name="about_description" class="form-control" rows="4">{{ $settings['about_description'] ?? '' }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Gambar</label>
                                    <div class="mb-2">
                                        <img src="{{ Str::startsWith($settings['about_image'] ?? '', 'http') ? $settings['about_image'] : asset('storage/' . ($settings['about_image'] ?? '')) }}" 
                                                alt="Current Image" class="img-thumbnail" style="max-height: 150px;">
                                    </div>
                                    <input type="file" name="about_image" class="form-control">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-2"></i>Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>

                        <!-- Visi & Misi Tab (Specific) -->
                        <div class="tab-pane fade" id="visimisi" role="tabpanel">
                            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <h6 class="mb-3 text-primary text-uppercase text-xs font-weight-bolder opacity-7">Konten Visi & Misi</h6>
                                <div class="mb-3">
                                    <label class="form-label">Visi</label>
                                    <textarea name="vision" class="form-control" rows="3" placeholder="Contoh: Menjadi pusat peradaban Islam...">{{ $settings['vision'] ?? '' }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Misi</label>
                                    <textarea name="mission" class="form-control" rows="5" placeholder="Contoh: &#10;1. Menyelenggarakan ibadah...&#10;2. Pendidikan berkualitas...">{{ $settings['mission'] ?? '' }}</textarea>
                                    <small class="text-muted">Untuk poin-poin Misi, gunakan baris baru (Enter) untuk setiap poin.</small>
                                </div>
                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-2"></i>Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>

                        <!-- Jadwal Sholat Tab -->
                        <div class="tab-pane fade" id="info" role="tabpanel">
                            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6 class="mb-3 text-primary text-uppercase text-xs font-weight-bolder opacity-7">Jadwal Sholat</h6>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Subuh</label>
                                                <input type="time" name="prayer_subuh" class="form-control" value="{{ $settings['prayer_subuh'] ?? '' }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Dzuhur</label>
                                                <input type="time" name="prayer_dzuhur" class="form-control" value="{{ $settings['prayer_dzuhur'] ?? '' }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Ashar</label>
                                                <input type="time" name="prayer_ashar" class="form-control" value="{{ $settings['prayer_ashar'] ?? '' }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Maghrib</label>
                                                <input type="time" name="prayer_maghrib" class="form-control" value="{{ $settings['prayer_maghrib'] ?? '' }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Isya</label>
                                                <input type="time" name="prayer_isya" class="form-control" value="{{ $settings['prayer_isya'] ?? '' }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Jumat</label>
                                                <input type="time" name="prayer_jumat" class="form-control" value="{{ $settings['prayer_jumat'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-2"></i>Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>

                        <!-- NEW ACTIVITIES TAB -->
                        <div class="tab-pane fade" id="activities" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0 text-primary text-uppercase text-xs font-weight-bolder opacity-7">Daftar Kegiatan Rutin</h6>
                                <button type="button" class="btn btn-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#addActivityModal">
                                    <i class="bi bi-plus-lg me-1"></i> Tambah Kegiatan
                                </button>
                            </div>
                            <div class="table-responsive p-0 border rounded">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kegiatan</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deskripsi</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($activities as $activity)
                                            <tr>
                                                <td class="px-3"><h6 class="mb-0 text-sm">{{ $activity->name }}</h6></td>
                                                <td><p class="text-xs text-secondary mb-0">{{ Str::limit($activity->description, 50) }}</p></td>

                                                <td class="align-middle text-center text-sm">
                                                    <span class="badge badge-sm bg-gradient-{{ $activity->is_active ? 'success' : 'secondary' }}">
                                                        {{ $activity->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-end pe-3">
                                                    <button type="button" class="btn btn-link text-dark px-2 mb-0" data-bs-toggle="modal" data-bs-target="#editActivityModal{{ $activity->id }}">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-link text-danger px-2 mb-0" onclick="confirmDeleteActivity({{ $activity->id }})">
                                                        Hapus
                                                    </button>
                                                    <form id="delete-activity-form-{{ $activity->id }}" action="{{ route('routine-activities.destroy', $activity->id) }}" method="POST" class="d-none">
                                                        @csrf @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>

                                            <!-- Edit Activity Modal -->
                                            <div class="modal fade" id="editActivityModal{{ $activity->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Kegiatan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('routine-activities.update', $activity->id) }}" method="POST">
                                                            @csrf @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Nama Kegiatan</label>
                                                                    <input type="text" name="name" class="form-control" value="{{ $activity->name }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Deskripsi</label>
                                                                    <textarea name="description" class="form-control" rows="3">{{ $activity->description }}</textarea>
                                                                </div>
                                                                    <div class="col-md-12 mb-3">
                                                                        <label class="form-label">Status</label>
                                                                        <select name="is_active" class="form-select">
                                                                            <option value="1" {{ $activity->is_active ? 'selected' : '' }}>Aktif</option>
                                                                            <option value="0" {{ !$activity->is_active ? 'selected' : '' }}>Tidak Aktif</option>
                                                                        </select>
                                                                    </div>
                                                                    <input type="hidden" name="icon" value="{{ $activity->icon }}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr><td colspan="5" class="text-center py-4">Belum ada kegiatan.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Footer & Sosmed Tab -->
                        <div class="tab-pane fade" id="social" role="tabpanel">
                            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <h6 class="mb-3 text-primary text-uppercase text-xs font-weight-bolder opacity-7">Kontak & Media Sosial</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Alamat Lengkap</label>
                                            <textarea name="contact_address" class="form-control" rows="3">{{ $settings['contact_address'] ?? '' }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">No. Telepon / WhatsApp</label>
                                            <input type="text" name="contact_phone" class="form-control" value="{{ $settings['contact_phone'] ?? '' }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="contact_email" class="form-control" value="{{ $settings['contact_email'] ?? '' }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Link Google Maps</label>
                                            <input type="url" name="contact_google_maps_link" class="form-control" value="{{ $settings['contact_google_maps_link'] ?? '' }}" placeholder="https://maps.google.com/...">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Facebook URL</label>
                                            <input type="text" name="social_facebook" class="form-control" value="{{ $settings['social_facebook'] ?? '' }}" placeholder="https://facebook.com/...">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Instagram URL</label>
                                            <input type="text" name="social_instagram" class="form-control" value="{{ $settings['social_instagram'] ?? '' }}" placeholder="https://instagram.com/...">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Youtube URL</label>
                                            <input type="text" name="social_youtube" class="form-control" value="{{ $settings['social_youtube'] ?? '' }}" placeholder="https://youtube.com/...">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi Footer</label>
                                            <textarea name="footer_description" class="form-control" rows="4" placeholder="Deskripsi singkat yang muncul di footer website...">{{ $settings['footer_description'] ?? 'Membangun peradaban umat melalui masjid yang makmur, transparan, dan modern.' }}</textarea>
                                            <small class="text-muted">Teks ini akan muncul di bagian bawah website (footer).</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Teks Copyright Footer</label>
                                            <input type="text" name="footer_copyright" class="form-control" value="{{ $settings['footer_copyright'] ?? '' }}" placeholder="&copy; 2026 Kas Masjid...">
                                            <small class="text-muted">Teks hak cipta di bagian paling bawah website. Gunakan {year} untuk tahun otomatis.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-2"></i>Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div> <!-- End Tab Content -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Activity Modal -->
<div class="modal fade" id="addActivityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kegiatan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('routine-activities.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                                                <input type="hidden" name="icon" value="bi-check-circle">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function confirmDeleteActivity(id) {
    if(confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')) {
        document.getElementById('delete-activity-form-' + id).submit();
    }
}
</script>
@endsection
