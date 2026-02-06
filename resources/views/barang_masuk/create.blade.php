@extends('dashboard')

@section('content')
<div class="container-fluid px-4">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Tambah Barang Masuk</h1>
            <p class="text-muted">Catat barang masuk dari supplier</p>
        </div>
        <a href="{{ route('barang-masuk.index') }}" class="btn btn-secondary shadow-sm">
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
            <form action="{{ route('barang-masuk.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <!-- Barang -->
                    <div class="col-md-6 mb-4">
                        <label for="BarangID" class="form-label fw-semibold">
                            <i class="fas fa-box me-2 text-primary"></i>Barang
                        </label>
                        <select name="BarangID" id="BarangID" class="form-select" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barangs as $b)
                                <option value="{{ $b->BarangID }}" {{ old('BarangID') == $b->BarangID ? 'selected' : '' }}>
                                    {{ $b->NamaBarang }} (Stok: {{ $b->Stock }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Supplier -->
                    <div class="col-md-6 mb-4">
                        <label for="SupplierID" class="form-label fw-semibold">
                            <i class="fas fa-truck me-2 text-primary"></i>Supplier
                        </label>
                        <select name="SupplierID" id="SupplierID" class="form-select" required>
                            <option value="">-- Pilih Supplier --</option>
                            @foreach($suppliers as $s)
                                <option value="{{ $s->SupplierID }}" {{ old('SupplierID') == $s->SupplierID ? 'selected' : '' }}>
                                    {{ $s->NamaSupplier }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- Jumlah Masuk -->
                    <div class="col-md-4 mb-4">
                        <label for="JumlahMasuk" class="form-label fw-semibold">
                            <i class="fas fa-arrow-down me-2 text-primary"></i>Jumlah Masuk
                        </label>
                        <div class="input-group">
                            <input type="number" 
                                   name="JumlahMasuk" 
                                   id="JumlahMasuk" 
                                   class="form-control" 
                                   value="{{ old('JumlahMasuk') }}" 
                                   min="1"
                                   placeholder="0"
                                   required>
                            <span class="input-group-text">pcs</span>
                        </div>
                    </div>

                    <!-- Tanggal Masuk -->
                    <div class="col-md-4 mb-4">
                        <label for="TanggalMasuk" class="form-label fw-semibold">
                            <i class="fas fa-calendar me-2 text-primary"></i>Tanggal Masuk
                        </label>
                        <input type="date" 
                               name="TanggalMasuk" 
                               id="TanggalMasuk" 
                               class="form-control" 
                               value="{{ old('TanggalMasuk', date('Y-m-d')) }}"
                               required>
                    </div>

                    <!-- Stock setelah tambah (calculated) -->
                    <div class="col-md-4 mb-4">
                        <label class="form-label fw-semibold text-muted">
                            <i class="fas fa-calculator me-2"></i>Stok Setelah Tambah
                        </label>
                        <div class="form-control bg-light">
                            <span id="stockAfter">-</span> pcs
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
                              placeholder="Catatan tambahan (opsional)">{{ old('Keterangan') }}</textarea>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-end gap-3 mt-4 pt-3 border-top">
                    <a href="{{ route('barang-masuk.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Barang Masuk
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
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const barangSelect = document.getElementById('BarangID');
        const jumlahInput = document.getElementById('JumlahMasuk');
        const stockAfterSpan = document.getElementById('stockAfter');
        
        // Store barang stock data
        const barangStocks = {
            @foreach($barangs as $b)
                '{{ $b->BarangID }}': {{ $b->Stock }},
            @endforeach
        };
        
        function calculateStockAfter() {
            const selectedBarangId = barangSelect.value;
            const jumlah = parseInt(jumlahInput.value) || 0;
            const currentStock = barangStocks[selectedBarangId] || 0;
            
            if (selectedBarangId && jumlah >= 0) {
                const newStock = currentStock + jumlah;
                stockAfterSpan.textContent = newStock;
                stockAfterSpan.className = newStock < 10 ? 'text-danger' : 'text-success';
            } else {
                stockAfterSpan.textContent = '-';
                stockAfterSpan.className = '';
            }
        }
        
        // Event listeners
        barangSelect.addEventListener('change', calculateStockAfter);
        jumlahInput.addEventListener('input', calculateStockAfter);
        
        // Initialize calculation
        calculateStockAfter();
        
        // Set default date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('TanggalMasuk').value = today;
    });
</script>

@endsection