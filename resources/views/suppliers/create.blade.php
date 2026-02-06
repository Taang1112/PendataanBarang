@extends('dashboard')

@section('content')
<div class="container-fluid px-4">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Tambah Supplier Baru</h1>
            <p class="text-muted">Tambahkan data supplier/pemasok baru</p>
        </div>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <!-- Alert Notifications -->
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <strong>Terjadi kesalahan!</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Form Card -->
    <div class="card shadow border-0">
        <div class="card-body">
            <form action="{{ route('suppliers.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <!-- Nama Supplier -->
                    <div class="col-md-6 mb-4">
                        <label for="NamaSupplier" class="form-label fw-semibold">
                            <i class="fas fa-user-tie me-2 text-primary"></i>Nama Supplier
                        </label>
                        <input type="text" 
                               name="NamaSupplier" 
                               id="NamaSupplier" 
                               class="form-control" 
                               value="{{ old('NamaSupplier') }}" 
                               placeholder="Masukkan nama supplier"
                               required>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-4">
                        <label for="Email" class="form-label fw-semibold">
                            <i class="fas fa-envelope me-2 text-primary"></i>Email
                        </label>
                        <input type="email" 
                               name="Email" 
                               id="Email" 
                               class="form-control" 
                               value="{{ old('Email') }}" 
                               placeholder="contoh@email.com">
                    </div>
                </div>

                <div class="row">
                    <!-- Alamat -->
                    <div class="col-md-8 mb-4">
                        <label for="Alamat" class="form-label fw-semibold">
                            <i class="fas fa-map-marker-alt me-2 text-primary"></i>Alamat
                        </label>
                        <textarea name="Alamat" 
                                  id="Alamat" 
                                  class="form-control" 
                                  rows="3"
                                  placeholder="Masukkan alamat lengkap">{{ old('Alamat') }}</textarea>
                    </div>

                    <!-- No Telp -->
                    <div class="col-md-4 mb-4">
                        <label for="NoTelp" class="form-label fw-semibold">
                            <i class="fas fa-phone me-2 text-primary"></i>No. Telepon
                        </label>
                        <input type="text" 
                               name="NoTelp" 
                               id="NoTelp" 
                               class="form-control" 
                               value="{{ old('NoTelp') }}" 
                               placeholder="0812-3456-7890">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-end gap-3 mt-4 pt-3 border-top">
                    <a href="{{ route('suppliers.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Supplier
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<style>
    .form-label {
        color: #2d3748;
        margin-bottom: 0.5rem;
    }
    
    .form-control, .form-select {
        border-radius: 0.5rem;
        border: 1px solid #d1d5db;
        padding: 0.625rem 0.875rem;
        transition: all 0.2s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .card {
        border-radius: 0.75rem;
        overflow: hidden;
    }
    
    .btn {
        border-radius: 0.5rem;
        font-weight: 500;
        padding: 0.625rem 1.25rem;
        transition: all 0.2s ease;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Phone number formatting
        const phoneInput = document.getElementById('NoTelp');
        
        phoneInput.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            
            if (value.length > 0) {
                // Format: 0812-3456-7890
                if (value.length <= 4) {
                    value = value;
                } else if (value.length <= 8) {
                    value = value.substring(0, 4) + '-' + value.substring(4);
                } else {
                    value = value.substring(0, 4) + '-' + value.substring(4, 8) + '-' + value.substring(8, 12);
                }
            }
            
            this.value = value;
        });
    });
</script>

@endsection