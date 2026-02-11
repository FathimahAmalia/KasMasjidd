@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Header & Filter -->
    <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
        <div>
            <h4 class="fw-bold mb-1 text-dark">Rekap Donasi Online</h4>
            <small class="text-muted">Laporan khusus donasi yang masuk via Online (Midtrans)</small>
        </div>
        
        <div class="d-flex gap-2">
            <form method="GET" class="d-flex gap-2 align-items-center flex-wrap">
                <div class="input-group shadow-sm" style="width: auto;">
                    <span class="input-group-text bg-white border-0"><i class="bi bi-calendar3"></i></span>
                    <input type="date" name="start_date" class="form-control border-0" value="{{ request('start_date') }}" placeholder="Dari">
                    <span class="input-group-text bg-white border-0">s/d</span>
                    <input type="date" name="end_date" class="form-control border-0" value="{{ request('end_date') }}" placeholder="Sampai">
                </div>
                
                <button class="btn btn-white shadow-sm text-dark fw-semibold px-3">
                    <i class="bi bi-filter me-1"></i> Filter
                </button>
                @if(request('start_date'))
                <a href="{{ route('rekap_donasi.index') }}" class="btn btn-danger shadow-sm px-3 fw-bold" title="Reset Filter">
                    <i class="bi bi-x-circle"></i>
                </a>
                @endif
            </form>
            <a href="{{ route('rekap_donasi.cetak', request()->all()) }}" target="_blank" class="btn btn-primary shadow-sm px-3 fw-bold">
                <i class="bi bi-printer me-2"></i> Cetak
            </a>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm bg-gradient-primary text-white">
                <div class="card-body p-4 text-center">
                    <div class="icon-box mx-auto bg-white bg-opacity-25 text-white rounded-circle mb-3 p-3" style="width: 64px; height: 64px;">
                        <i class="bi bi-wallet2 fs-3"></i>
                    </div>
                    <small class="text-white-50 text-uppercase fw-bold">Total Donasi Terkumpul</small>
                    <h3 class="fw-bold text-white mt-2">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="icon-box mx-auto bg-primary bg-opacity-10 text-primary rounded-circle mb-3 p-3" style="width: 64px; height: 64px;">
                        <i class="bi bi-mosque fs-3"></i>
                    </div>
                    <small class="text-muted text-uppercase fw-bold">Untuk Kas Masjid</small>
                    <h3 class="fw-bold text-dark mt-2">Rp {{ number_format($totalMasjid, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="icon-box mx-auto bg-success bg-opacity-10 text-success rounded-circle mb-3 p-3" style="width: 64px; height: 64px;">
                        <i class="bi bi-people fs-3"></i>
                    </div>
                    <small class="text-muted text-uppercase fw-bold">Untuk Kas Sosial</small>
                    <h3 class="fw-bold text-dark mt-2">Rp {{ number_format($totalSosial, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h6 class="mb-0 fw-bold">Rincian Transaksi Donasi Berhasil</h6>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center mb-0 table-hover">
                <thead class="bg-light">
                    <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="5%">No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Donatur</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tipe</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pesan</th>
                        <th class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 pe-4">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donasis as $donasi)
                    <tr>
                        <td class="text-center py-3">
                            <span class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span>
                        </td>
                        <td>
                            <span class="text-secondary text-xs font-weight-bold">{{ Carbon\Carbon::parse($donasi->tanggal_donasi)->format('d/m/Y H:i') }}</span>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="text-dark text-sm fw-bold">{{ $donasi->nama }}</span>
                                <span class="text-muted text-xs">{{ $donasi->email }}</span>
                            </div>
                        </td>
                        <td>
                            @if($donasi->jenis_donasi == 'masjid')
                                <span class="badge bg-primary bg-opacity-10 text-primary">Kas Masjid</span>
                            @else
                                <span class="badge bg-success bg-opacity-10 text-success">Kas Sosial</span>
                            @endif
                        </td>
                        <td>
                             @if($donasi->pesan)
                                <span class="text-secondary text-xs fst-italic">"{{ Str::limit($donasi->pesan, 30) }}"</span>
                            @else
                                <span class="text-muted text-xs">-</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <span class="text-dark text-sm fw-bold">Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-inbox fs-1 text-muted opacity-50 mb-2"></i>
                                <span class="text-muted fw-bold">Tidak ada data donasi sukses untuk periode ini</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
