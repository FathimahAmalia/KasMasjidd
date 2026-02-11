@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Header & Filter -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h4 class="fw-bold mb-1 text-dark">Laporan Kas Terpadu</h4>
            <small class="text-muted">Pantau arus kas Masjid dan Sosial dalam satu tempat</small>
        </div>
        
        <div class="d-flex gap-2 align-items-center flex-wrap">
            <form method="GET" class="d-flex gap-2 align-items-center">
                <input type="hidden" name="tab" value="{{ $activeTab }}">
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-calendar-range"></i></span>
                    <input type="date" name="start_date" class="form-control border-start-0 ps-0" value="{{ $startDate }}" placeholder="Mulai">
                </div>
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-arrow-right"></i></span>
                    <input type="date" name="end_date" class="form-control border-start-0 ps-0" value="{{ $endDate }}" placeholder="Sampai">
                </div>
                <button class="btn btn-light shadow-sm text-dark fw-bold px-3 d-inline-flex align-items-center">
                    <i class="bi bi-filter me-2"></i> Filter
                </button>
            </form>
            
            <div class="btn-group shadow-sm">
                <a href="{{ route('laporan_kas.cetak', ['tab' => $activeTab, 'start_date' => $startDate, 'end_date' => $endDate]) }}" target="_blank" class="btn btn-primary fw-bold d-inline-flex align-items-center">
                    <i class="bi bi-printer me-2"></i> Cetak
                </a>
                <a href="{{ route('laporan_kas.export_excel', ['tab' => $activeTab, 'start_date' => $startDate, 'end_date' => $endDate]) }}" target="_blank" class="btn btn-success fw-bold d-inline-flex align-items-center">
                    <i class="bi bi-file-earmark-excel me-2"></i> Export Excel
                </a>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-pills mb-4 gap-2" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a href="{{ route('laporan_kas.index', ['tab' => 'masjid', 'start_date' => $startDate, 'end_date' => $endDate]) }}" 
               class="nav-link {{ $activeTab == 'masjid' ? 'active shadow-sm' : 'bg-white text-secondary' }} px-4 py-2 fw-bold rounded-pill">
                <i class="bi bi-mosque me-2"></i> Kas Masjid
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="{{ route('laporan_kas.index', ['tab' => 'sosial', 'start_date' => $startDate, 'end_date' => $endDate]) }}" 
               class="nav-link {{ $activeTab == 'sosial' ? 'active shadow-sm' : 'bg-white text-secondary' }} px-4 py-2 fw-bold rounded-pill">
                <i class="bi bi-people me-2"></i> Kas Sosial
            </a>
        </li>
    </ul>

    <!-- Summary Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="icon-box mx-auto bg-success bg-opacity-10 text-success rounded-circle mb-3 p-3" style="width: 64px; height: 64px;">
                        <i class="bi bi-arrow-down-circle fs-3"></i>
                    </div>
                    <small class="text-muted text-uppercase fw-bold">Total Pemasukan</small>
                    <h3 class="fw-bold text-success mt-2">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="icon-box mx-auto bg-danger bg-opacity-10 text-danger rounded-circle mb-3 p-3" style="width: 64px; height: 64px;">
                        <i class="bi bi-arrow-up-circle fs-3"></i>
                    </div>
                    <small class="text-muted text-uppercase fw-bold">Total Pengeluaran</small>
                    <h3 class="fw-bold text-danger mt-2">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm bg-gradient-primary text-white">
                <div class="card-body p-4 text-center">
                    <div class="icon-box mx-auto bg-white bg-opacity-25 text-white rounded-circle mb-3 p-3" style="width: 64px; height: 64px;">
                        <i class="bi bi-wallet2 fs-3"></i>
                    </div>
                    <small class="text-white-50 text-uppercase fw-bold">Saldo Akhir</small>
                    <h3 class="fw-bold text-white mt-2">Rp {{ number_format($saldo, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold">Rincian Transaksi {{ ucfirst($activeTab) }}</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center mb-0 table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="5%">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Uraian</th>
                                <th class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 pe-4">Masuk</th>
                                <th class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 pe-4">Keluar</th>
                                <th class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 pe-4">Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rekaps as $rekap)
                            <tr>
                                <td class="text-center py-3">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                </td>
                                <td>
                                    <span class="text-secondary text-xs font-weight-bold">{{ Carbon\Carbon::parse($rekap->tanggal)->format('d/m/Y') }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-sm fw-bold d-block">
                                        {{ $rekap->jenis == 'pemasukan' ? ($rekap->sumber_dana ?? '-') : ($rekap->jenis_pengeluaran ?? '-') }}
                                    </span>
                                    @if($rekap->keterangan)
                                    <small class="text-muted text-xs d-block fst-italic mt-1">
                                        <i class="bi bi-info-circle me-1"></i>{{ $rekap->keterangan }}
                                    </small>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    @if($rekap->jenis == 'pemasukan')
                                        <span class="text-success text-sm fw-bold">Rp {{ number_format($rekap->jumlah, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-secondary text-xs opacity-5">-</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    @if($rekap->jenis == 'pengeluaran')
                                        <span class="text-danger text-sm fw-bold">Rp {{ number_format($rekap->jumlah, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-secondary text-xs opacity-5">-</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <span class="text-dark text-sm fw-bold">Rp {{ number_format($rekap->saldo_akhir, 0, ',', '.') }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-inbox fs-1 text-muted opacity-50 mb-2"></i>
                                        <span class="text-muted fw-bold">Tidak ada data transaksi untuk periode ini</span>
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
</div>

@endsection