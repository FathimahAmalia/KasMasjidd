@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-gradient mb-1" style="font-size: 2rem;">
                <i class="bi bi-people-fill me-3 text-primary"></i>Manajemen Pengguna
            </h1>
            <p class="text-muted mb-0" style="font-size: 1rem;">Kelola pengguna dan hak akses sistem</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-lg shadow-sm">
            <i class="bi bi-person-plus me-2"></i>Tambah Pengguna
        </a>
    </div>

    <!-- Alerts -->
    @if (session('success'))
        <div id="success-alert" class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div id="error-alert" class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-3 p-3 me-3">
                            <i class="bi bi-people fs-3"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0 text-dark">{{ $users->count() }}</h4>
                            <small class="text-muted">Total Pengguna</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-success bg-opacity-10 text-success rounded-3 p-3 me-3">
                            <i class="bi bi-shield-check fs-3"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0 text-dark">{{ $users->where('roles.0.name', 'admin')->count() }}</h4>
                            <small class="text-muted">Administrator</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-info bg-opacity-10 text-info rounded-3 p-3 me-3">
                            <i class="bi bi-person fs-3"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0 text-dark">{{ $users->where('roles.0.name', 'user')->count() }}</h4>
                            <small class="text-muted">User Biasa</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card border-0 shadow-custom">
        <div class="card-header bg-white border-0 py-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="bi bi-list-ul me-2 text-primary"></i>Daftar Pengguna
                    </h5>
                    <small class="text-muted">Kelola semua pengguna sistem</small>
                </div>
                <div class="d-flex gap-2">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari pengguna..." style="max-width: 250px;">
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="usersTable">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0 fw-bold text-muted">#</th>
                            <th class="border-0 fw-bold text-muted">Pengguna</th>
                            <th class="border-0 fw-bold text-muted">Email</th>
                            <th class="border-0 fw-bold text-muted">Role</th>
                            <th class="border-0 fw-bold text-muted">Bergabung</th>
                            <th class="border-0 fw-bold text-muted text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-bottom border-light">
                                <td class="ps-4 py-3 fw-semibold text-muted">{{ $loop->iteration }}</td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        @if($user->profile_picture)
                                            <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                                 alt="Profile"
                                                 class="rounded-circle me-3 shadow-sm"
                                                 style="width: 45px; height: 45px; object-fit: cover; border: 2px solid var(--primary-light);">
                                        @else
                                            <div class="bg-gradient-primary text-white d-flex align-items-center justify-content-center rounded-circle me-3 shadow-sm"
                                                 style="width: 45px; height: 45px; border: 2px solid var(--primary-light);">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <h6 class="mb-0 fw-bold text-dark">{{ $user->name }}</h6>
                                            <small class="text-muted">{{ '@'.$user->name }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="fw-semibold text-dark">{{ $user->email }}</span>
                                </td>
                                <td class="py-3">
                                    @foreach($user->roles as $role)
                                        <span class="badge {{ $role->name == 'admin' ? 'bg-danger' : 'bg-info' }} bg-opacity-10 text-{{ $role->name == 'admin' ? 'danger' : 'info' }} px-3 py-2 fw-semibold">
                                            <i class="bi {{ $role->name == 'admin' ? 'bi-shield-check' : 'bi-person' }} me-1"></i>
                                            {{ ucfirst($role->name) }}
                                        </span>
                                    @endforeach
                                </td>
                                <td class="py-3">
                                    <span class="text-muted fw-medium">{{ $user->created_at->format('d M Y') }}</span>
                                    <small class="text-muted d-block">{{ $user->created_at->diffForHumans() }}</small>
                                </td>
                                <td class="py-3 text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           data-bs-toggle="tooltip"
                                           title="Edit Pengguna">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        @if(Auth::id() !== $user->id)
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="confirmDelete({{ $user->id }}, '{{ addslashes($user->name) }}')"
                                                    data-bs-toggle="tooltip"
                                                    title="Hapus Pengguna">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-people fs-1 mb-3 d-block text-muted"></i>
                                        <h6 class="fw-bold">Belum ada pengguna</h6>
                                        <small>Belum ada pengguna yang terdaftar di sistem</small>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('#usersTable tbody tr');

    tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endsection
