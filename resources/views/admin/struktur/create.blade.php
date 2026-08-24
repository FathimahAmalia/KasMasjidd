@extends('layouts.app')

@section('title', 'Tambah Struktur Masjid')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h4 class="fw-bold mb-1">
            Tambah Struktur Masjid
        </h4>

        <p class="text-muted">
            Tambahkan pengurus atau jabatan baru
        </p>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form
                action="{{ route('admin.struktur.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf


                {{-- NAMA --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nama Pengurus
                    </label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama') }}"
                        class="form-control @error('nama') is-invalid @enderror"
                        placeholder="Contoh: Ahmad Fauzi"
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
        value="{{ old('jabatan') }}"
        class="form-control @error('jabatan') is-invalid @enderror"
        placeholder="Contoh: Ketua DKM"
        required>

    @error('jabatan')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- ATASAN / INDUK STRUKTUR --}}

<div class="mb-3">

    <label class="form-label fw-semibold">
        Atasan / Posisi Di Bawah
    </label>

    <select
        name="parent_id"
        class="form-select @error('parent_id') is-invalid @enderror">

        <option value="">
            — Posisi Paling Atas / Ketua —
        </option>

        @foreach(\App\Models\Struktur::where('status', true)
            ->orderBy('urutan')
            ->orderBy('id')
            ->get() as $atasan)

            <option
                value="{{ $atasan->id }}"
                {{ old('parent_id') == $atasan->id ? 'selected' : '' }}>

                {{ $atasan->jabatan }} — {{ $atasan->nama }}

            </option>

        @endforeach

    </select>

    <small class="text-muted">
        Kosongkan jika pengurus ini berada di posisi paling atas.
        Jika dipilih, pengurus akan ditampilkan di bawah posisi tersebut.
    </small>

    @error('parent_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- FOTO --}}

<div class="mb-3">

    <label class="form-label fw-semibold">
        Foto Pengurus
    </label>

    <input
        type="file"
        name="foto"
        class="form-control @error('foto') is-invalid @enderror"
        accept="image/*">

    <small class="text-muted">
        JPG, JPEG, PNG, WEBP — maksimal 2 MB.
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
                        value="{{ old('urutan', 0) }}"
                        min="0"
                        class="form-control">

                    <small class="text-muted">
                        Semakin kecil angka, semakin di atas.
                    </small>

                </div>


                {{-- STATUS --}}

                <div class="form-check form-switch mb-4">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="status"
                        value="1"
                        id="status"
                        checked>

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
                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection