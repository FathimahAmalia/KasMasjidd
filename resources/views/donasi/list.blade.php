@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow rounded rounded-3 border-0">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-gradient">Daftar Donasi Online</h5>
                <!-- Optional: Filter or Export button -->
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3">No</th>
                                <th class="py-3">Tanggal</th>
                                <th class="py-3">Donatur</th>
                                <th class="py-3">Jenis</th>
                                <th class="py-3 text-end">Jumlah</th>
                                <th class="py-3 text-center">Status</th>
                                <th class="py-3 text-end">ID Transaksi</th>
                                <th class="pe-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donasi as $d)
                            <tr class="align-middle">
                                <td class="ps-4 text-muted">{{ $loop->iteration + $donasi->firstItem() - 1 }}</td>
                                <td>
                                    <span class="fw-semibold text-dark">{{ $d->created_at->format('d M Y') }}</span>
                                    <small class="d-block text-muted">{{ $d->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $d->nama }}</div>
                                    <small class="text-muted">{{ $d->email }}</small>
                                </td>
                                <td>
                                    @if($d->jenis_donasi == 'masjid')
                                        <span class="badge bg-primary bg-opacity-10 text-primary">Kas Masjid</span>
                                    @else
                                        <span class="badge bg-success bg-opacity-10 text-success">Kas Sosial</span>
                                    @endif
                                </td>
                                <td class="text-end fw-bold">Rp {{ number_format($d->jumlah, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    @if($d->status == 'success')
                                        <span class="badge bg-success rounded-pill px-3">Berhasil</span>
                                    @elseif($d->status == 'pending')
                                        <span class="badge bg-warning text-dark rounded-pill px-3">Pending</span>
                                    @elseif($d->status == 'failed')
                                        <span class="badge bg-danger rounded-pill px-3">Gagal</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill px-3">{{ ucfirst($d->status) }}</span>
                                    @endif
                                </td>
                                <td class="text-end font-monospace small text-muted">{{ $d->transaction_id }}</td>
                                <td class="pe-4 text-center">
                                    @if($d->status == 'pending')
                                        <form action="{{ route('donasi.check_status', $d->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary py-1 px-3" title="Cek Status Pembayaran">
                                                <i class="bi bi-arrow-clockwise me-1"></i>Cek
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">Belum ada data donasi</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-0 py-3">
                {{ $donasi->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
