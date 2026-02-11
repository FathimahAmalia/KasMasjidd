@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="h4 mb-0">Daftar Kegiatan Masjid</h6>
        <a href="{{ route('activities.create') }}" class="btn btn-primary text-white">
            <i class="bi bi-plus-lg me-2"></i>Tambah Kegiatan
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kegiatan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kategori</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activities as $activity)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="{{ Str::startsWith($activity->image, 'http') ? $activity->image : asset('storage/' . $activity->image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="activity" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $activity->title }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ Str::limit($activity->description, 50) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $activity->category }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm bg-gradient-success">Active</span>
                                </td>
                                <td class="align-middle text-end pe-4">
                                    <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-sm btn-info text-white me-2">Edit</a>
                                    <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger text-white" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
