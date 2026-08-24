@extends('layouts.app')

@section('title', 'Edit Struktur Masjid')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h4 class="fw-bold mb-1">
            Edit Struktur Masjid
        </h4>

        <p class="text-muted">
            Perbarui data pengurus masjid
        </p>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form
                action="{{ route('admin.struktur.update', $struktur->id) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')


                {{-- NAMA --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nama Pengurus
                    </label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama', $struktur->nama) }}"
                        class="form-control @error('nama') is-invalid @enderror"
                        required>

                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- JABATAN --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Jabatan
                    </label>

                    <input
                        type="text"
                        name="jabatan"
                        value="{{ old('jabatan', $struktur->jabatan) }}"
                        class="form-control @error('jabatan') is-invalid @enderror"
                        required>

                    @error('jabatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- FOTO LAMA --}}

                @if($struktur->foto)

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Foto Saat Ini
                        </label>

                        <div>

                            <img
                                src="{{ asset('storage/' . $struktur->foto) }}"
                                width="120"
                                height="120"
                                class="rounded-circle object-fit-cover">

                        </div>

                    </div>

                @endif


                {{-- FOTO BARU --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Ganti Foto
                    </label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control @error('foto') is-invalid @enderror"
                        accept="image/*">

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti foto.
                    </small>

                    @error('foto')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- URUTAN --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Urutan
                    </label>

                    <input
                        type="number"
                        name="urutan"
                        value="{{ old('urutan', $struktur->urutan) }}"
                        min="0"
                        class="form-control">

                </div>


                {{-- STATUS --}}

                <div class="form-check form-switch mb-4">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="status"
                        value="1"
                        id="status"
                        {{ $struktur->status ? 'checked' : '' }}>

                    <label class="form-check-label" for="status">
                        Aktif
                    </label>

                </div>


                {{-- BUTTON --}}

                <div class="d-flex gap-2">

                    <a
                        href="{{ route('admin.struktur.index') }}"
                        class="btn btn-secondary">

                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali

                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-save me-1"></i>
                        Update

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection