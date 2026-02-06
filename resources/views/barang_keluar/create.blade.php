@extends('dashboard')

@section('content')
<div class="container-fluid px-4">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Catat Barang Keluar</h1>
            <p class="text-muted">Catat pengeluaran barang dari stok</p>
        </div>
        <a href="{{ route('barang-keluar.index') }}" class="btn btn-secondary shadow-sm">
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
            <form action="{{ route('barang-keluar.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <!-- Barang -->
                    <div class="col-md-6 mb-4">
                        <label for="BarangID" class="form-label fw-semibold">
                            <i class="fas fa-box me-2 text-primary"></i>Barang
                        </label>
                        <select name="BarangID" id="BarangID" class="form-select" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->BarangID }}" 
                                        data-stock="{{ $barang->Stock }}"
                                        {{ old('BarangID') == $barang->BarangID ? 'selected' : '' }}>
                                    {{ $barang->NamaBarang }} (Stok: {{ $barang->Stock }})
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Stok tersedia: <span id="currentStock">0</span> pcs</small>
                    </div>

                    <!-- Jumlah Keluar -->
                    <div class="col-md-3 mb-4">
                        <label for="JumlahKeluar" class="form-label fw-semibold">
                            <i class="fas fa-arrow-up me-2 text-primary"></i>Jumlah Keluar
                        </label>
                        <div class="input-group">
                            <input type="number" 
                                   name="JumlahKeluar" 
                                   id="JumlahKeluar" 
                                   class="form-control" 
                                   value="{{ old('JumlahKeluar') }}" 
                                   min="1"
                                   placeholder="0"
                                   required>
                            <span class="input-group-text">pcs</span>
                        </div>
                    </div>

                    <!-- Tanggal Keluar -->
                    <div class="col-md-3 mb-4">
                        <label for="TanggalKeluar" class="form-label fw-semibold">
                            <i class="fas fa-calendar me-2 text-primary"></i>Tanggal Keluar
                        </label>
                        <input type="date" 
                               name="TanggalKeluar" 
                               id="TanggalKeluar" 
                               class="form-control" 
                               value="{{ old('TanggalKeluar', date('Y-m-d')) }}"
                               required>
                    </div>
                </div>

                <!-- Stock setelah keluar (calculated) -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle me-2 fa-lg"></i>
                                <div>
                                    <strong>Informasi Stok:</strong>
                                    <div class="mt-1">
                                        Stok setelah pengurangan: <span id="stockAfter" class="fw-bold">0</span> pcs
                                    </div>
                                    <div id="stockWarning" class="text-danger mt-1" style="display: none;">
                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                        <span id="warningMessage"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Keterangan -->
                <div class="mb-4">
                    <label for="Keterangan" class="form-label fw-semibold">
                        <i class="fas fa-align-left me-2 text-primary"></i>Keterangan
                    </label>
                    <textarea name="Keterangan" 
                              id="Keterangan" 
                              class="form-control" 
                              rows="3"
                              placeholder="Alasan/tujuan pengeluaran barang (opsional)">{{ old('Keterangan') }}</textarea>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-end gap-3 mt-4 pt-3 border-top">
                    <a href="{{ route('barang-keluar.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-arrow-up me-2"></i>Catat Barang Keluar
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
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
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
    
    .alert-info {
        background-color: #d1ecf1;
        border-color: #bee5eb;
        color: #0c5460;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const barangSelect = document.getElementById('BarangID');
        const jumlahInput = document.getElementById('JumlahKeluar');
        const currentStockSpan = document.getElementById('currentStock');
        const stockAfterSpan = document.getElementById('stockAfter');
        const stockWarningDiv = document.getElementById('stockWarning');
        const warningMessageSpan = document.getElementById('warningMessage');
        
        function updateStockInfo() {
            const selectedOption = barangSelect.options[barangSelect.selectedIndex];
            const currentStock = parseInt(selectedOption.getAttribute('data-stock')) || 0;
            const jumlah = parseInt(jumlahInput.value) || 0;
            const stockAfter = currentStock - jumlah;
            
            // Update displays
            currentStockSpan.textContent = currentStock;
            stockAfterSpan.textContent = stockAfter;
            
            // Color coding
            if (stockAfter < 0) {
                stockAfterSpan.className = 'text-danger';
                stockWarningDiv.style.display = 'block';
                warningMessageSpan.textContent = 'Stok tidak mencukupi!';
                jumlahInput.classList.add('is-invalid');
            } else if (stockAfter < 10) {
                stockAfterSpan.className = 'text-warning';
                stockWarningDiv.style.display = 'block';
                warningMessageSpan.textContent = 'Stok akan tersisa kurang dari 10 pcs';
                jumlahInput.classList.remove('is-invalid');
            } else {
                stockAfterSpan.className = 'text-success';
                stockWarningDiv.style.display = 'none';
                jumlahInput.classList.remove('is-invalid');
            }
            
            // Update stock after color
            if (stockAfter < 0) {
                stockAfterSpan.className = 'text-danger';
            } else if (stockAfter < 10) {
                stockAfterSpan.className = 'text-warning';
            } else {
                stockAfterSpan.className = 'text-success';
            }
        }
        
        // Event listeners
        barangSelect.addEventListener('change', updateStockInfo);
        jumlahInput.addEventListener('input', updateStockInfo);
        
        // Initialize
        updateStockInfo();
        
        // Set default date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('TanggalKeluar').value = today;
        
        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const selectedOption = barangSelect.options[barangSelect.selectedIndex];
            const currentStock = parseInt(selectedOption.getAttribute('data-stock')) || 0;
            const jumlah = parseInt(jumlahInput.value) || 0;
            
            if (currentStock - jumlah < 0) {
                e.preventDefault();
                alert('Stok tidak mencukupi! Silahkan periksa jumlah yang akan dikeluarkan.');
                jumlahInput.focus();
            }
        });
    });
</script>

@endsection