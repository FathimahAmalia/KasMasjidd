@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header pb-0 text-start">
                    <h4 class="font-weight-bolder">Tambah Kegiatan Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('activities.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Judul Kegiatan</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" name="category" required>
                                <option value="Rutin">Rutin</option>
                                <option value="Sosial">Sosial</option>
                                <option value="Pendidikan">Pendidikan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar Kegiatan</label>
                            <input type="file" class="form-control" name="image" required>
                        </div>
                        <div class="text-end">
                            <a href="{{ route('activities.index') }}" class="btn btn-light mb-0">Kembali</a>
                            <button type="submit" class="btn btn-primary mb-0 ms-2">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
