@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header pb-0 text-start">
                    <h4 class="font-weight-bolder">Edit Kegiatan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('activities.update', $activity->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Judul Kegiatan</label>
                            <input type="text" class="form-control" name="title" value="{{ $activity->title }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" name="category" required>
                                <option value="Rutin" {{ $activity->category == 'Rutin' ? 'selected' : '' }}>Rutin</option>
                                <option value="Sosial" {{ $activity->category == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                                <option value="Pendidikan" {{ $activity->category == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                <option value="Lainnya" {{ $activity->category == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="4" required>{{ $activity->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar (Biarkan kosong jika tidak berubah)</label>
                            <input type="file" class="form-control mb-2" name="image">
                            @if($activity->image)
                                <img src="{{ Str::startsWith($activity->image, 'http') ? $activity->image : asset('storage/' . $activity->image) }}" class="img-thumbnail" style="height: 150px">
                            @endif
                        </div>
                        <div class="text-end">
                            <a href="{{ route('activities.index') }}" class="btn btn-light mb-0">Kembali</a>
                            <button type="submit" class="btn btn-primary mb-0 ms-2">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
