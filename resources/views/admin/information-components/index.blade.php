@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Daftar Komponen Informasi</h6>
                    <a href="{{ route('information-components.create') }}" class="btn btn-primary btn-sm mb-0">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Komponen
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Urutan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipe</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ikon</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($components as $component)
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 ps-2">{{ $component->order }}</p>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $component->title }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-info">{{ $component->type }}</span>
                                    </td>
                                    <td>
                                        @if($component->icon)
                                            <i class="{{ $component->icon }}"></i> {{ $component->icon }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @if($component->is_active)
                                            <span class="badge badge-sm bg-gradient-success">Aktif</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-secondary">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('information-components.edit', $component->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                        <form action="{{ route('information-components.destroy', $component->id) }}" method="POST" class="d-inline-block ms-2" onsubmit="return confirm('Apakah Anda yakin ingin menghapus komponen ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger text-gradient p-0 m-0 text-xs font-weight-bold">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">Belum ada komponen informasi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
