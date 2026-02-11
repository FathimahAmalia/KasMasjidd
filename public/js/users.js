document.addEventListener('DOMContentLoaded', function() {
    const successAlert = document.getElementById('success-alert');
    if (successAlert) {
        Swal.fire({
            title: 'Berhasil!',
            text: successAlert.textContent.trim(),
            icon: 'success',
            confirmButtonColor: '#28a745',
            confirmButtonText: 'OK'
        });
    }

    const errorAlert = document.getElementById('error-alert');
    if (errorAlert) {
        Swal.fire({
            title: 'Gagal!',
            text: errorAlert.textContent.trim(),
            icon: 'error',
            confirmButtonColor: '#d33',
            confirmButtonText: 'OK'
        });
    }
});

function confirmDelete(userId, userName) {
    Swal.fire({
        title: 'Hapus Pengguna?',
        text: `Anda yakin ingin menghapus pengguna "${userName}"? Tindakan ini tidak dapat dibatalkan.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Sedang Menghapus...',
                text: 'Mohon tunggu...',
                icon: 'info',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            document.getElementById('delete-form-' + userId).submit();
        }
    });
}
