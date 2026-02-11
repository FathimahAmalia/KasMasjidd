@extends('layouts.app')

@section('content')

 <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="fw-bold text-gradient mb-1" style="font-size: 2rem;">Dashboard</h1>
        <p class="text-muted mb-0" style="font-size: 1rem;">Ringkasan keuangan masjid & sosial</p>
    </div>

    <div class="d-flex align-items-center gap-3">
         <a href="{{ route('profile.edit') }}" class="d-flex align-items-center text-decoration-none">
            <div class="d-flex align-items-center gap-3">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                         alt="Profile"
                         class="rounded-circle shadow-sm"
                         style="width: 48px; height: 48px; object-fit: cover; border: 3px solid var(--primary-light);">
                @else
                    <div class="bg-gradient-primary text-white d-flex align-items-center justify-content-center rounded-circle shadow-sm"
                         style="width: 48px; height: 48px; border: 3px solid var(--primary-light);">
                        <i class="bi bi-person-fill fs-5"></i>
                    </div>
                @endif
                <div class="d-none d-md-block text-end">
                    <div class="fw-semibold text-dark" style="font-size: 0.95rem;">{{ Auth::user()->name }}</div>
                    <small class="text-muted fw-medium" style="font-size: 0.8rem;">
                        {{ Auth::user()->roles()->first()->name ?? 'User' }}
                    </small>
                </div>
            </div>
        </a>

        <button class="btn btn-light shadow-sm d-lg-none border-custom" onclick="toggleSidebar()" style="border-radius: 12px;">
            <i class="bi bi-list fs-5"></i>
        </button>
    </div>
</div>

 <div class="row g-3 mb-4">
     <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            <div class="card-body p-4 d-flex flex-column justify-content-center">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div>
                        <small class="text-white-50 text-uppercase fw-bold mb-2 d-block">Waktu Sekarang</small>
                        <h2 class="fw-bold mb-0" id="digitalClock" style="font-size: 2.5rem;">00:00:00</h2>
                        <small class="text-white-50" id="dateDisplay">Loading...</small>
                    </div>
                    <div class="text-white" style="font-size: 3rem; opacity: 0.5;">
                        <i class="bi bi-clock-history"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0 fw-bold text-dark">Kalender</h6>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-light" onclick="previousMonth()">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button class="btn btn-sm btn-light" onclick="goToToday()">Hari Ini</button>
                        <button class="btn btn-sm btn-light" onclick="nextMonth()">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>
                <div id="calendar" style="font-size: 0.9rem;"></div>
            </div>
        </div>
    </div>
</div>

 <div class="row g-4 mb-4">
     <div class="col-md-4">
        <div class="card h-100 border-0">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-3 p-3 me-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-mosque fs-3"></i>
                    </div>
                    <div class="flex-grow-1">
                        <small class="text-muted text-uppercase fw-bold mb-1 d-block" style="font-size: 0.75rem;">Saldo Masjid</small>
                        <h3 class="fw-bold mb-0 text-dark" style="font-size: 1.5rem;">Rp {{ number_format($saldoMasjid, 0, ',', '.') }}</h3>
                        <small class="text-success fw-medium" style="font-size: 0.8rem;">
                            <i class="bi bi-arrow-up-circle me-1"></i>+12.5% dari bulan lalu
                        </small>
                    </div>
                </div>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: 75%;"></div>
                </div>
            </div>
        </div>
    </div>

     <div class="col-md-4">
        <div class="card h-100 border-0">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box bg-success bg-opacity-10 text-success rounded-3 p-3 me-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-people fs-3"></i>
                    </div>
                    <div class="flex-grow-1">
                        <small class="text-muted text-uppercase fw-bold mb-1 d-block" style="font-size: 0.75rem;">Saldo Sosial</small>
                        <h3 class="fw-bold mb-0 text-dark" style="font-size: 1.5rem;">Rp {{ number_format($saldoSosial, 0, ',', '.') }}</h3>
                        <small class="text-success fw-medium" style="font-size: 0.8rem;">
                            <i class="bi bi-arrow-up-circle me-1"></i>+8.2% dari bulan lalu
                        </small>
                    </div>
                </div>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 60%;"></div>
                </div>
            </div>
        </div>
    </div>

     <div class="col-md-4">
        <div class="card h-100 border-0">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box bg-info bg-opacity-10 text-info rounded-3 p-3 me-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-wallet2 fs-3"></i>
                    </div>
                    <div class="flex-grow-1">
                        <small class="text-muted text-uppercase fw-bold mb-1 d-block" style="font-size: 0.75rem;">Total Aset</small>
                        <h3 class="fw-bold mb-0 text-dark" style="font-size: 1.5rem;">Rp {{ number_format($totalAset, 0, ',', '.') }}</h3>
                        <small class="text-info fw-medium" style="font-size: 0.8rem;">Gabungan seluruh kas</small>
                    </div>
                </div>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 85%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

 <div class="card border-0 shadow-custom mb-4">
    <div class="card-header bg-white border-0 py-3">
        <h5 class="mb-0 fw-bold text-dark">
            <i class="bi bi-bar-chart-line me-2 text-primary"></i>Statistik Keuangan (12 Bulan Terakhir)
        </h5>
    </div>
    <div class="card-body">
        <canvas id="financialChart" style="max-height: 400px;"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('financialChart').getContext('2d');
        
        // Data passed from controller
        const months = @json($months ?? []);
        const incomeData = @json($incomeData ?? []);
        const expenseData = @json($expenseData ?? []);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: incomeData,
                        backgroundColor: 'rgba(16, 185, 129, 0.7)', // Success color
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 1,
                        borderRadius: 4
                    },
                    {
                        label: 'Pengeluaran',
                        data: expenseData,
                        backgroundColor: 'rgba(239, 68, 68, 0.7)', // Danger color
                        borderColor: 'rgba(239, 68, 68, 1)',
                        borderWidth: 1,
                        borderRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                }
            }
        });
    });
</script>



<script>
function updateClock() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    
    document.getElementById('digitalClock').textContent = `${hours}:${minutes}:${seconds}`;
    
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateString = now.toLocaleDateString('id-ID', options);
    document.getElementById('dateDisplay').textContent = dateString;
}

let currentDate = new Date();

function renderCalendar() {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const daysInMonth = lastDay.getDate();
    const startingDayOfWeek = firstDay.getDay();
    
    const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                       'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    const dayNames = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
    
    let html = `
        <div style="margin-bottom: 15px; text-align: center;">
            <h6 class="mb-0 fw-bold text-dark">${monthNames[month]} ${year}</h6>
        </div>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
    `;
    
    for (let i = 0; i < 7; i++) {
        html += `<th style="padding: 8px; text-align: center; font-weight: bold; border-bottom: 2px solid #f0f0f0; color: #667eea;">${dayNames[i]}</th>`;
    }
    html += `</tr><tr>`;
    
    for (let i = 0; i < startingDayOfWeek; i++) {
        html += `<td style="padding: 8px; text-align: center; background-color: #f8f9fa;"></td>`;
    }
    
    const today = new Date();
    for (let day = 1; day <= daysInMonth; day++) {
        if ((day + startingDayOfWeek - 1) % 7 === 0 && day !== 1) {
            html += `</tr><tr>`;
        }
        
        const isToday = day === today.getDate() && 
                       month === today.getMonth() && 
                       year === today.getFullYear();
        
        const cellStyle = isToday 
            ? 'background-color: #667eea; color: white; font-weight: bold; border-radius: 6px;'
            : 'background-color: white; color: #344767;';
        
        html += `<td style="padding: 8px; text-align: center; border: 1px solid #f0f0f0; ${cellStyle} cursor: pointer;" 
                    onmouseover="this.style.backgroundColor='${isToday ? '#667eea' : '#f8f9fa'}'" 
                    onmouseout="this.style.backgroundColor='${isToday ? '#667eea' : 'white'}'">
                    ${day}
                </td>`;
    }
    
    const remainingCells = (42 - (daysInMonth + startingDayOfWeek));
    for (let i = 0; i < remainingCells; i++) {
        html += `<td style="padding: 8px; text-align: center; background-color: #f8f9fa;"></td>`;
    }
    html += `</tr></table>`;
    
    document.getElementById('calendar').innerHTML = html;
}

function previousMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
}

function goToToday() {
    currentDate = new Date();
    renderCalendar();
}

updateClock();
renderCalendar();
setInterval(updateClock, 1000);
</script>

@endsection
