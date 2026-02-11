@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="mb-4">
        <h4 class="fw-bold mb-1 text-dark">Edit Profil</h4>
        <small class="text-muted">Update data diri dan foto profil Anda</small>
    </div>

    <!-- Success Alert -->
    @if($message = session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row g-4">
        <!-- Profile Picture Section -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-4">
                        @if(Auth::user()->profile_picture)
                            <img id="profilePreview" src="{{ asset('storage/' . Auth::user()->profile_picture) }}" 
                                 alt="Profile" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #e9ecef;">
                        @else
                            <div id="profilePreview" class="rounded-circle d-inline-flex align-items-center justify-content-center bg-light" 
                                 style="width: 150px; height: 150px; border: 4px solid #e9ecef;">
                                <i class="bi bi-person fs-1 text-muted"></i>
                            </div>
                        @endif
                    </div>
                    <h5 class="fw-bold text-dark">{{ Auth::user()->name }}</h5>
                    <small class="text-muted">{{ Auth::user()->email }}</small>
                    
                    @php
                        $userRoles = Auth::user()->roles()->pluck('name')->toArray();
                    @endphp
                    <div class="mt-3">
                        @foreach($userRoles as $role)
                            <span class="badge bg-primary">{{ ucfirst($role) }}</span>
                        @endforeach 
                    </div>
                    
                    <small class="text-muted d-block mt-4 fst-italic">
                        <i class="bi bi-info-circle me-1"></i>Ubah foto di bawah
                    </small>
                </div>
            </div>
        </div>

        <!-- Edit Form Section -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold">Data Profil</h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nama Lengkap -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold text-dark">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', Auth::user()->name) }}" placeholder="Masukkan nama lengkap">
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold text-dark">Email</label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email', Auth::user()->email) }}" placeholder="Masukkan email">
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Profile Picture -->
                        <div class="mb-4">
                            <label for="profile_picture" class="form-label fw-semibold text-dark">Foto Profil</label>
                            <input type="file" id="profile_picture" name="profile_picture" class="form-control @error('profile_picture') is-invalid @enderror" 
                                   accept="image/*" onchange="previewImage(event)">
                            @error('profile_picture')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-1"></i>Format: JPEG, PNG, JPG, GIF | Maksimal: 2MB
                            </small>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary fw-bold">
                                <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-secondary fw-bold">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('profilePreview');
            // Clear previous content and add the new image
            preview.innerHTML = `<img src="${e.target.result}" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #e9ecef;" alt="Profile Preview">`;
        };
        reader.readAsDataURL(file);
    }
}

// Optional: Show file name when selected
document.getElementById('profile_picture')?.addEventListener('change', function(e) {
    if (e.target.files[0]) {
        const fileName = e.target.files[0].name;
        // You can optionally show file name feedback
        console.log('File selected: ' + fileName);
    }
});
</script>

@endsection
