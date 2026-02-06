@extends('dashboard')

@section('content')
<div class="container-fluid px-4">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Kategori</h1>
            <p class="text-muted">Edit kategori "{{ $kategori->NamaKategori }}"</p>
        </div>
        <a href="{{ route('kategoris.index') }}" class="btn btn-secondary shadow-sm">
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
            <form action="{{ route('kategoris.update', $kategori->KategoriID) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Nama Kategori -->
                    <div class="col-md-6 mb-4">
                        <label for="NamaKategori" class="form-label fw-semibold">
                            <i class="fas fa-tag me-2 text-primary"></i>Nama Kategori
                        </label>
                        <input type="text" 
                               name="NamaKategori" 
                               id="NamaKategori" 
                               class="form-control" 
                               value="{{ old('NamaKategori', $kategori->NamaKategori) }}" 
                               required>
                        <small class="text-muted">Contoh: Elektronik, Pakaian, Makanan, dll.</small>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label for="Deskripsi" class="form-label fw-semibold">
                        <i class="fas fa-align-left me-2 text-primary"></i>Deskripsi
                    </label>
                    <textarea name="Deskripsi" 
                              id="Deskripsi" 
                              class="form-control" 
                              rows="4"
                              required>{{ old('Deskripsi', $kategori->Deskripsi) }}</textarea>
                    <div class="text-end mt-1">
                        <small class="text-muted" id="charCount">{{ strlen($kategori->Deskripsi) }}/500 karakter</small>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-end gap-3 mt-4 pt-3 border-top">
                    <a href="{{ route('kategoris.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Kategori
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
        // Character counter for description
        const descTextarea = document.getElementById('Deskripsi');
        const charCount = document.getElementById('charCount');
        
        descTextarea.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = `${length}/500 karakter`;
            
            if (length > 500) {
                charCount.style.color = '#dc2626';
            } else if (length > 450) {
                charCount.style.color = '#ea580c';
            } else {
                charCount.style.color = '#6b7280';
            }
        });
        
        // Trigger input event to update counter
        descTextarea.dispatchEvent(new Event('input'));
    });
</script>

@endsection