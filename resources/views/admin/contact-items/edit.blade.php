@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Kontak</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('contact-items.update', $contactItem->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="label" class="form-control-label">Label (Contoh: WhatsApp Admin)</label>
                                    <input class="form-control" type="text" name="label" id="label" value="{{ $contactItem->label }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="value" class="form-control-label">Nilai Teks (Contoh: 08123456789)</label>
                                    <input class="form-control" type="text" name="value" id="value" value="{{ $contactItem->value }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="icon" class="form-control-label">Ikon (Bootstrap Icons)</label>
                                    <input class="form-control" type="text" name="icon" id="icon" value="{{ $contactItem->icon }}" placeholder="bi-whatsapp">
                                    <small class="text-muted">Lihat daftar ikon di <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="url" class="form-control-label">Link URL (Opsional)</label>
                                    <input class="form-control" type="text" name="url" id="url" value="{{ $contactItem->url }}" placeholder="https://wa.me/628123456789">
                                    <small class="text-muted">Isi jika ingin bisa diklik (misal: mailto:, tel:, atau https://)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="order" class="form-control-label">Urutan Tampil</label>
                                    <input class="form-control" type="number" name="order" id="order" value="{{ $contactItem->order }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group pt-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $contactItem->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Status Aktif</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('contact-items.index') }}" class="btn btn-light m-0 me-2">Batal</a>
                            <button type="submit" class="btn btn-primary m-0">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
