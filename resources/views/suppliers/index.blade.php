@extends('dashboard')

@section('content')
<div class="container-fluid px-4">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Data Supplier</h1>
            <p class="text-muted">Kelola data supplier/pemasok barang</p>
        </div>
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-2"></i>Tambah Supplier
        </a>
    </div>

   {{-- FILTER + SEARCH --}}
   <form method="GET" class="p-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control"
               placeholder="Cari nama / email / no telp..."
               value="{{ request('search') }}">
        <button class="btn btn-primary">Search</button>
    </div>
</form>
    

    <!-- Alert Notifications -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Card Container -->
    <div class="card shadow border-0">
        <div class="card-body p-0">
            
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="ps-4">No</th>
                            <th scope="col">Nama Supplier</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No Telp</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suppliers as $index => $s)
                        <tr class="align-middle">
                            <td class="ps-4 fw-semibold">{{ $index + 1 }}</td>
                            <td>
                                <div class="fw-semibold">{{ $s->NamaSupplier }}</div>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 200px;" 
                                     data-bs-toggle="tooltip" 
                                     data-bs-title="{{ $s->Alamat }}">
                                    {{ $s->Alamat ?: '-' }}
                                </div>
                            </td>
                            <td>
                                @if($s->NoTelp)
                                <a href="tel:{{ $s->NoTelp }}" class="text-decoration-none">
                                    <i class="fas fa-phone me-1 text-muted"></i>{{ $s->NoTelp }}
                                </a>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($s->Email)
                                <a href="mailto:{{ $s->Email }}" class="text-decoration-none">
                                    <i class="fas fa-envelope me-1 text-muted"></i>{{ $s->Email }}
                                </a>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2 pe-4">
                                    <!-- Edit Link -->
                                    <a href="{{ route('suppliers.edit', $s->SupplierID) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    
                                    <!-- Delete Form -->
                                    <form action="{{ route('suppliers.destroy', $s->SupplierID) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        
                        @if(count($suppliers) == 0)
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="py-5">
                                    <i class="fas fa-truck fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Belum ada data supplier</h5>
                                    <p class="text-muted">Tambahkan supplier pertama Anda</p>
                                    <a href="{{ route('suppliers.create') }}" class="btn btn-primary mt-2">
                                        <i class="fas fa-plus me-2"></i>Tambah Supplier
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<style>
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border-top: 1px solid #dee2e6;
        border-bottom: 2px solid #dee2e6;
    }
    
    .table td {
        vertical-align: middle;
        padding: 1rem 0.75rem;
    }
    
    .table tbody tr {
        transition: all 0.2s ease;
    }
    
    .table tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    
    .card {
        border-radius: 0.75rem;
        overflow: hidden;
    }
    
    .btn {
        border-radius: 0.5rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .btn-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }
    
    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: white;
    }
    
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }
</style>

<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

@endsection