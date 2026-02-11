@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1 text-dark">Pemasukan Kas Masjid</h4>
            <small class="text-muted">Kelola data pemasukan dana masjid</small>
        </div>
    </div>

    @if(session('success'))
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false
    });
    </script>
    @endif

    <div class="row g-4">
        <!-- Left Side: Form & Stats -->
        <div class="col-md-4">
            
            <!-- Stat Card - Total Pemasukan -->
            <div class="card mb-4 bg-success text-white overflow-hidden border-0 shadow-sm">
                <div class="card-body position-relative p-4">
                    <div class="d-flex justify-content-between align-items-center position-relative z-1">
                        <div>
                            <small class="text-white-50 text-uppercase fw-bold">Total Pemasukan</small>
                            <h3 class="fw-bold mb-0 mt-1">Rp {{ number_format((float)$totalPemasukan, 0, ',', '.') }}</h3>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="bi bi-arrow-down-circle fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stat Card - Saldo Kas Masjid -->
            <div class="card mb-4 bg-primary text-white overflow-hidden border-0 shadow-sm">
                <div class="card-body position-relative p-4">
                    <div class="d-flex justify-content-between align-items-center position-relative z-1">
                        <div>
                            <small class="text-white-50 text-uppercase fw-bold">Saldo Kas Masjid</small>
                            <h3 class="fw-bold mb-0 mt-1">Rp {{ number_format((float)$saldo ?? 0, 0, ',', '.') }}</h3>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="bi bi-wallet2 fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Input Form -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold">Input Pemasukan Baru</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="/pemasukan-masjid">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required value="{{ date('Y-m-d') }}">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Sumber Dana</label>
                            <select class="form-select mb-2" id="sumber_select" required>
                                <option value="" selected disabled>Pilih Sumber Dana</option>
                                <option value="Infaq">Infaq</option>
                                <option value="Kencleng">Kencleng</option>
                                <option value="Donatur">Donatur</option>
                                <option value="Sedekah">Sedekah</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            <input type="text" name="sumber_dana" id="sumber_input" class="form-control" placeholder="Masukkan Sumber Dana Lainnya" style="display: none;" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Nominal (Rp)</label>
                            <input type="text" id="nominal" name="nominal" class="form-control fw-bold text-success" placeholder="0" required inputmode="numeric">
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="2" placeholder="Catatan tambahan..."></textarea>
                        </div>
                        
                        <button class="btn btn-primary w-100 py-2 rounded-3 fw-bold">
                            <i class="bi bi-plus-lg me-2"></i> Simpan Pemasukan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Side: Recent Data -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold">Riwayat Pemasukan</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center mb-0 table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">Tanggal</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Sumber</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Keterangan</th>
                                <th class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 pe-4">Nominal</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $item)
                            <tr>
                                <td class="ps-4">
                                    <span class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-sm fw-semibold">{{ $item->sumber_dana }}</span>
                                </td>
                                <td>
                                    <span class="text-secondary text-xs">{{ Str::limit($item->keterangan, 30) }}</span>
                                </td>
                                <td class="align-middle text-end pe-4">
                                    <span class="text-success text-sm fw-bold">+ Rp {{ number_format($item->nominal, 0, ',', '.') }}</span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-link text-dark px-2 mb-0" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                        <i class="bi bi-pencil-square text-primary"></i>
                                    </button>
                                    
                                    <form action="/pemasukan-masjid/{{ $item->id }}" method="POST" class="d-inline form-hapus">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger px-2 mb-0">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-inbox fs-1 text-muted opacity-50 mb-2"></i>
                                        <span class="text-muted fw-bold">Belum ada data pemasukan</span>
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

    <!-- Modals -->
    @foreach($data as $item)
    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold">Edit Pemasukan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="/pemasukan-masjid/{{ $item->id }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ $item->tanggal }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Sumber Dana</label>
                            @php
                                $options = ['Infaq', 'Kencleng', 'Donatur', 'Sedekah'];
                                $isLainnya = !in_array($item->sumber_dana, $options);
                            @endphp
                            <select class="form-select mb-2 sumber-select-edit" data-id="{{ $item->id }}">
                                <option value="Infaq" {{ $item->sumber_dana == 'Infaq' ? 'selected' : '' }}>Infaq</option>
                                <option value="Kencleng" {{ $item->sumber_dana == 'Kencleng' ? 'selected' : '' }}>Kencleng</option>
                                <option value="Donatur" {{ $item->sumber_dana == 'Donatur' ? 'selected' : '' }}>Donatur</option>
                                <option value="Sedekah" {{ $item->sumber_dana == 'Sedekah' ? 'selected' : '' }}>Sedekah</option>
                                <option value="Lainnya" {{ $isLainnya ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <input type="text" name="sumber_dana" id="sumber_input_{{ $item->id }}" class="form-control sumber-input-edit" value="{{ $item->sumber_dana }}" style="{{ $isLainnya ? 'display:block' : 'display:none' }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Nominal</label>
                            <input type="text" name="nominal" class="form-control nominal-input fw-bold text-success" 
                                value="{{ number_format($item->nominal, 0, ',', '.') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" value="{{ $item->keterangan }}">
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary rounded-pill px-4">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        // Function to format currency
        function formatCurrency(value) {
            // Remove all non-numeric characters
            let numericValue = value.replace(/[^\d]/g, '');
            if (numericValue === '') return '';
            // Format as currency
            return new Intl.NumberFormat('id-ID').format(numericValue);
        }

        // Handle input on the main form
        const nominalInput = document.getElementById('nominal');
        if (nominalInput) {
            nominalInput.addEventListener('input', function () {
                this.value = formatCurrency(this.value);
            });

            // Handle paste events
            nominalInput.addEventListener('paste', function (e) {
                setTimeout(() => {
                    this.value = formatCurrency(this.value);
                }, 10);
            });
        }

        // Handle inputs in edit modals
        document.querySelectorAll('.nominal-input').forEach(input => {
            input.addEventListener('input', function () {
                this.value = formatCurrency(this.value);
            });

            input.addEventListener('paste', function (e) {
                setTimeout(() => {
                    this.value = formatCurrency(this.value);
                }, 10);
            });
        });

        // Delete confirmation
        document.querySelectorAll('.form-hapus').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus data?',
                    text: 'Data yang dihapus tidak dapat dikembalikan',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Main Form Logic
            const mainSelect = document.getElementById('sumber_select');
            const mainInput = document.getElementById('sumber_input');

            if(mainSelect && mainInput) {
                mainSelect.addEventListener('change', function() {
                    if (this.value === 'Lainnya') {
                        mainInput.value = '';
                        mainInput.style.display = 'block';
                        mainInput.focus();
                    } else {
                        mainInput.value = this.value;
                        mainInput.style.display = 'none';
                    }
                });
            }

            // Edit Modal Logic
            document.querySelectorAll('.sumber-select-edit').forEach(select => {
                select.addEventListener('change', function() {
                    const id = this.dataset.id;
                    const input = document.getElementById('sumber_input_' + id);
                    if (this.value === 'Lainnya') {
                        // Only clear if switching TO lainnya from a standard option
                        // If it was already custom text, we might want to keep it? 
                        // But standard behavior is usually reset or keep.
                        // For simplicity: if switching to Lainnya, let user type.
                        if(!input.value || ['Infaq', 'Kencleng', 'Donatur', 'Sedekah'].includes(input.value)) {
                             input.value = '';
                        }
                        input.style.display = 'block';
                        input.focus();
                    } else {
                        input.value = this.value;
                        input.style.display = 'none';
                    }
                });
            });
        });
    </script>
</div>
@endsection
