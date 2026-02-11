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
                            <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">Halaman Informasi</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab">Kontak & Sosmed</button>
                        </li>
                    </ul>

                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="tab-content" id="settingsTabContent">
                            
                            <!-- General & Hero Tab -->
                            <div class="tab-pane fade show active" id="general" role="tabpanel">
                                <h6 class="mb-3 text-primary text-uppercase text-xs font-weight-bolder opacity-7">Hero Section (Halaman Depan)</h6>
                                <div class="mb-3">
                                    <label class="form-label">Judul Utama</label>
                                    <input type="text" name="hero_title" class="form-control" value="{{ $settings['hero_title'] ?? '' }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Singkat</label>
                                    <textarea name="hero_description" class="form-control" rows="3">{{ $settings['hero_description'] ?? '' }}</textarea>
                                </div>
                            </div>

                            <!-- About Tab -->
                            <div class="tab-pane fade" id="about" role="tabpanel">
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
                            </div>

                            <!-- Info & Prayer Times Tab -->
                            <div class="tab-pane fade" id="info" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6 border-end">
                                        <h6 class="mb-3 text-primary text-uppercase text-xs font-weight-bolder opacity-7">Profil Lengkap</h6>
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi Profil (Halaman Informasi)</label>
                                            <textarea name="profile_description" class="form-control" rows="8">{{ $settings['profile_description'] ?? '' }}</textarea>
                                            <small class="text-muted">Teks ini akan muncul di halaman /informasi bagian "Tentang Masjid"</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ps-4">
                                        <h6 class="mb-3 text-primary text-uppercase text-xs font-weight-bolder opacity-7">Jadwal Sholat</h6>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Subuh</label>
                                                <input type="time" name="prayer_subuh" class="form-control" value="{{ $settings['prayer_subuh'] ?? '' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Dzuhur</label>
                                                <input type="time" name="prayer_dzuhur" class="form-control" value="{{ $settings['prayer_dzuhur'] ?? '' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Ashar</label>
                                                <input type="time" name="prayer_ashar" class="form-control" value="{{ $settings['prayer_ashar'] ?? '' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Maghrib</label>
                                                <input type="time" name="prayer_maghrib" class="form-control" value="{{ $settings['prayer_maghrib'] ?? '' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Isya</label>
                                                <input type="time" name="prayer_isya" class="form-control" value="{{ $settings['prayer_isya'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Tab -->
                            <div class="tab-pane fade" id="contact" role="tabpanel">
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
                                            <input type="text" name="contact_google_maps_link" class="form-control" value="{{ $settings['contact_google_maps_link'] ?? '' }}" placeholder="https://maps.google.com/...">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Facebook URL</label>
                                            <input type="text" name="social_facebook" class="form-control" value="{{ $settings['social_facebook'] ?? '' }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Instagram URL</label>
                                            <input type="text" name="social_instagram" class="form-control" value="{{ $settings['social_instagram'] ?? '' }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Youtube URL</label>
                                            <input type="text" name="social_youtube" class="form-control" value="{{ $settings['social_youtube'] ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="mt-4 pt-3 border-top text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
