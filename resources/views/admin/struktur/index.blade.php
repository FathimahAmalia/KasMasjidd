@extends('layouts.app')

@section('title', 'Struktur Masjid')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">
                Struktur Masjid
            </h4>

            <p class="text-muted mb-0">
                Kelola struktur dan kepengurusan masjid
            </p>
        </div>

        <a href="{{ route('admin.struktur.create') }}"
           class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Struktur
        </a>

    </div>


    {{-- ALERT --}}

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif


    {{-- CARD --}}

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th width="100">Foto</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th width="100">Urutan</th>
                            <th width="100">Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($strukturs as $struktur)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>

                                @if($struktur->foto)

                                    <img
                                        src="{{ asset('storage/' . $struktur->foto) }}"
                                        width="60"
                                        height="60"
                                        class="rounded-circle object-fit-cover"
                                        alt="{{ $struktur->nama }}">

                                @else

                                    <div
                                        class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                        style="width:60px;height:60px;">

                                        <i class="bi bi-person fs-4 text-secondary"></i>

                                    </div>

                                @endif

                            </td>

                            <td>
                                <strong>
                                    {{ $struktur->nama }}
                                </strong>
                            </td>

                            <td>
                                {{ $struktur->jabatan }}
                            </td>

                            <td>
                                {{ $struktur->urutan }}
                            </td>

                            <td>

                                @if($struktur->status)

                                    <span class="badge bg-success">
                                        Aktif
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        Tidak Aktif
                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="d-flex gap-1">

                                    <a href="{{ route('admin.struktur.edit', $struktur->id) }}"
                                       class="btn btn-sm btn-warning">

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    <form
                                        action="{{ route('admin.struktur.destroy', $struktur->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center py-5">

                                <i class="bi bi-diagram-3 fs-1 text-muted"></i>

                                <p class="text-muted mt-2 mb-0">
                                    Belum ada data struktur masjid.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection