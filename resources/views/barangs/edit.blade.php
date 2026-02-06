@extends('dashboard')

@section('content')
<div class="container-fluid px-4">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Barang</h1>
            <p class="text-muted">Edit data barang "{{ $barang->NamaBarang }}"</p>
        </div>
        <a href="{{ route('barangs.index') }}" class="btn btn-secondary shadow-sm">
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
            <form action="{{ route('barangs.update', $barang->BarangID) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Kategori -->
                        <div class="mb-4">
                            <label for="KategoriID" class="form-label fw-semibold">
                                <i class="fas fa-tag me-2 text-primary"></i>Kategori
                            </label>
                            <select name="KategoriID" id="KategoriID" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $k)
                                    <option value="{{ $k->KategoriID }}" 
                                        {{ $barang->KategoriID == $k->KategoriID ? 'selected' : '' }}>
                                        {{ $k->NamaKategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Nama Barang -->
                        <div class="mb-4">
                            <label for="NamaBarang" class="form-label fw-semibold">
                                <i class="fas fa-box me-2 text-primary"></i>Nama Barang
                            </label>
                            <input type="text" 
                                   name="NamaBarang" 
                                   id="NamaBarang" 
                                   class="form-control" 
                                   value="{{ old('NamaBarang', $barang->NamaBarang) }}" 
                                   required>
                        </div>

                        <!-- Harga -->
                        <div class="mb-4">
                            <label for="Harga" class="form-label fw-semibold">
                                <i class="fas fa-money-bill-wave me-2 text-primary"></i>Harga
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" 
                                       name="Harga" 
                                       id="Harga" 
                                       class="form-control" 
                                       value="{{ old('Harga', $barang->Harga) }}" 
                                       min="0"
                                       required>
                            </div>
                        </div>

                        <!-- Stock -->
                        <div class="mb-4">
                            <label for="Stock" class="form-label fw-semibold">
                                <i class="fas fa-layer-group me-2 text-primary"></i>Stock
                            </label>
                            <input type="number" 
                                   name="Stock" 
                                   id="Stock" 
                                   class="form-control" 
                                   value="{{ old('Stock', $barang->Stock) }}" 
                                   min="0"
                                   required>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Foto -->
                        <div class="mb-4">
                            <label for="Foto" class="form-label fw-semibold">
                                <i class="fas fa-camera me-2 text-primary"></i>Foto Barang
                            </label>
                            <input type="file" 
                                   name="Foto" 
                                   id="Foto" 
                                   class="form-control"
                                   accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                            
                            <!-- Current Image -->
                            @if($barang->Foto)
                            <div class="mt-3">
                                <p class="mb-2 text-muted">Foto saat ini:</p>
                                <div class="position-relative d-inline-block">
                                    <img src="{{ asset('foto_barang/'.$barang->Foto) }}" 
                                         class="img-thumbnail" 
                                         style="max-width: 200px;"
                                         data-bs-toggle="tooltip"
                                         data-bs-title="Klik untuk memperbesar">
                                </div>
                            </div>
                            @endif
                            
                            <!-- Preview New Image -->
                            <div class="mt-3" id="imagePreview" style="display: none;">
                                <p class="mb-2 text-muted">Preview foto baru:</p>
                                <img id="previewImage" class="img-thumbnail" style="max-width: 200px;">
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
                                      rows="5"
                                      required>{{ old('Deskripsi', $barang->Deskripsi) }}</textarea>
                            <div class="text-end mt-1">
                                <small class="text-muted" id="charCount">{{ strlen($barang->Deskripsi) }}/500 karakter</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-end gap-3 mt-4 pt-3 border-top">
                    <a href="{{ route('barangs.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Barang
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
    
    .input-group-text {
        background-color: #f9fafb;
        border-color: #d1d5db;
    }
    
    .img-thumbnail {
        border-radius: 0.5rem;
        border: 1px solid #e5e7eb;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image preview for new image
        const fotoInput = document.getElementById('Foto');
        const previewImage = document.getElementById('previewImage');
        const imagePreview = document.getElementById('imagePreview');
        
        fotoInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                
                reader.readAsDataURL(this.files[0]);
            } else {
                imagePreview.style.display = 'none';
            }
        });
        
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
        
        // Tooltip for current image
        const currentImage = document.querySelector('img[src*="foto_barang"]');
        if (currentImage) {
            currentImage.style.cursor = 'pointer';
            currentImage.addEventListener('click', function() {
                const modal = new bootstrap.Modal(document.getElementById('imageModal'));
                document.getElementById('modalImage').src = this.src;
                modal.show();
            });
        }
    });
</script>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid rounded" alt="">
            </div>
        </div>
    </div>
</div>

@endsection