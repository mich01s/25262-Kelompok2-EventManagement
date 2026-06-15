@extends('adminmainbaru')

@section('title', 'Tambah Pengisi Acara')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="mb-0">
                <i class="fas fa-user-plus"></i> Tambah Pengisi Acara Baru
            </h1>
            <p class="text-muted">Masukkan informasi lengkap untuk pengisi acara/pembicara baru</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card shadow-sm" style="max-width: 600px;">
        <div class="card-header bg-light border-bottom">
            <h5 class="mb-0">
                <i class="fas fa-form"></i> Form Tambah Pengisi Acara
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('pengisi.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <!-- Nama Pengisi Acara Field -->
                <div class="mb-3">
                    <label for="nama_pengisi_acara" class="form-label">
                        <i class="fas fa-user"></i> Nama Pengisi Acara
                        <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="text" 
                        class="form-control @error('nama_pengisi_acara') is-invalid @enderror" 
                        id="nama_pengisi_acara" 
                        name="nama_pengisi_acara"
                        placeholder="Masukkan nama pengisi acara"
                        value="{{ old('nama_pengisi_acara') }}"
                        required>
                    <div class="form-text">
                        <small>Nama harus unik dan tidak boleh kosong</small>
                    </div>
                    @error('nama_pengisi_acara')
                        <div class="invalid-feedback d-block">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('pengisi.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap Validation Script -->
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    }());
</script>

<style>
    h1 {
        color: #2c3e50;
        font-weight: 600;
    }

    .card {
        border: none;
        border-radius: 0.5rem;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
    }
</style>
@endsection

