@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tambah Komponen Informasi</h6>
                </div>
                <div class="card-body">
                    <!-- Trix Editor Resources -->
                    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
                    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
                    <style>
                        trix-toolbar [data-trix-button-group="file-tools"] {
                            display: none;
                        }
                    </style>

                    <form action="{{ route('information-components.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title" class="form-control-label">Judul Komponen</label>
                                    <input class="form-control" type="text" name="title" id="title" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type" class="form-control-label">Tipe Komponen</label>
                                    <select class="form-control" name="type" id="type" required>
                                        <option value="text">Teks Bebas (HTML)</option>
                                        <option value="prayer_times">Widget Jadwal Sholat</option>
                                        <option value="routine_activities">Widget Kegiatan Rutin</option>
                                        <option value="contact_list">Widget Daftar Kontak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="icon" class="form-control-label">Ikon (Bootstrap Icons)</label>
                                    <input class="form-control" type="text" name="icon" id="icon" placeholder="bi-info-circle">
                                    <small class="text-muted">Lihat daftar ikon di <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="order" class="form-control-label">Urutan Tampil</label>
                                    <input class="form-control" type="number" name="order" id="order" value="0" required>
                                </div>
                            </div>
                            
                            <!-- Image Input -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image" class="form-control-label">Gambar (Opsional)</label>
                                    <input class="form-control" type="file" name="image" id="image">
                                    <small class="text-muted">Format: jpg, jpeg, png. Maks: 2MB.</small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="content" class="form-control-label">Konten (Khusus Tipe Teks)</label>
                                    <input id="content" type="hidden" name="content">
                                    <trix-editor input="content"></trix-editor>
                                    <small class="text-muted">Isi hanya jika tipe komponen adalah "Teks Bebas".</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                                    <label class="form-check-label" for="is_active">Status Aktif</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('information-components.index') }}" class="btn btn-light m-0 me-2">Batal</a>
                            <button type="submit" class="btn btn-primary m-0">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
