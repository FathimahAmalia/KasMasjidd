@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1 text-dark">Pengeluaran Kas Masjid</h4>
            <small class="text-muted">Kelola data pengeluaran dana masjid</small>
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
            
            <!-- Stat Card - Total Pengeluaran -->
            <div class="card mb-4 bg-danger text-white overflow-hidden border-0 shadow-sm">
                <div class="card-body position-relative p-4">
                    <div class="d-flex justify-content-between align-items-center position-relative z-1">
                        <div>
                            <small class="text-white-50 text-uppercase fw-bold">Total Pengeluaran</small>
                            <h3 class="fw-bold mb-0 mt-1">Rp {{ number_format($total,0,',','.') }}</h3>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="bi bi-dash-circle fs-3"></i>
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
                            <h3 class="fw-bold mb-0 mt-1">Rp {{ number_format($saldo ?? 0,0,',','.') }}</h3>
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
                    <h6 class="mb-0 fw-bold">Input Pengeluaran Baru</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="/pengeluaran-masjid">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required value="{{ date('Y-m-d') }}">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Jenis Pengeluaran</label>
                            <input type="text" name="jenis_pengeluaran" class="form-control" placeholder="Contoh: Beli Lampu" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Nominal (Rp)</label>
                            <input type="text" id="nominal" name="nominal" class="form-control fw-bold text-danger" placeholder="0" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Ambil Dana Dari</label>
                            <select name="sumber_dana" class="form-select mb-2" required>
                                <option value="Kas Masjid" selected>Kas Masjid</option>
                                <option value="Kas Sosial">Kas Sosial</option>
                            </select>
                            <small class="text-xs text-muted">*Pilih <strong>Kas Sosial</strong> untuk pengeluaran santunan/bantuan.</small>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="2" placeholder="Catatan tambahan..."></textarea>
                        </div>
                        
                        <button class="btn btn-danger w-100 py-2 rounded-3 fw-bold">
                            <i class="bi bi-dash-lg me-2"></i> Simpan Pengeluaran
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <!-- Right Side: Recent Data -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold">Riwayat Pengeluaran</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center mb-0 table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">Tanggal</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis</th>
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
                                    <span class="text-dark text-sm fw-semibold">{{ $item->jenis_pengeluaran }}</span>
                                </td>
                                <td>
                                    <span class="text-secondary text-xs">{{ Str::limit($item->keterangan, 30) }}</span>
                                </td>
                                <td class="align-middle text-end pe-4">
                                    <span class="text-danger text-sm fw-bold">- Rp {{ number_format($item->nominal, 0, ',', '.') }}</span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-link text-dark px-2 mb-0" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                        <i class="bi bi-pencil-square text-primary"></i>
                                    </button>
                                    
                                    <form action="/pengeluaran-masjid/{{ $item->id }}" method="POST" class="d-inline form-hapus">
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
                                        <span class="text-muted fw-bold">Belum ada data pengeluaran</span>
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
                    <h5 class="modal-title fw-bold">Edit Pengeluaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="/pengeluaran-masjid/{{ $item->id }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ $item->tanggal }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Jenis Pengeluaran</label>
                            <input type="text" name="jenis_pengeluaran" class="form-control" value="{{ $item->jenis_pengeluaran }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Nominal</label>
                            <input type="text" name="nominal" class="form-control nominal-input fw-bold text-danger" 
                                value="{{ number_format($item->nominal, 0, ',', '.') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" value="{{ $item->keterangan }}">
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-danger rounded-pill px-4">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        document.getElementById('nominal')?.addEventListener('input', function () {
            let value = this.value.replace(/\D/g, '');
            this.value = new Intl.NumberFormat('id-ID').format(value);
        });

        document.querySelectorAll('.nominal-input').forEach(input => {
            input.addEventListener('input', function () {
                let value = this.value.replace(/\D/g, '');
                this.value = new Intl.NumberFormat('id-ID').format(value);
            });
        });

        document.querySelectorAll('.form-hapus').forEach(form => {
            form.addEventListener('submit', function(e){
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
                }).then((result)=>{
                    if(result.isConfirmed){
                        form.submit();
                    }
                });
            });
        });
    </script>
</div>
@endsection
