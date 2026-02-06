@extends('dashboard')

@section('content')
<div class="container-fluid px-4">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
            <p class="text-muted">Kelola data barang dengan mudah dan cepat</p>
        </div>
        <a href="/barangs/create" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-2"></i>Tambah Barang
        </a>
    </div>

    <form method="GET" class="p-3">
    <div class="row g-2 mb-2">
        <div class="col-md-3">
            <select name="kategori" class="form-control">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $k)
                    <option value="{{ $k->KategoriID }}"
                        {{ request('kategori') == $k->KategoriID ? 'selected' : '' }}>
                        {{ $k->NamaKategori }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="input-group">
        <input type="text" name="search" class="form-control"
               placeholder="Cari barang..."
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
                            <th scope="col">Kategori</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col" class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barangs as $barang)
                        <tr class="align-middle">
                            <td class="ps-4 fw-semibold">{{ $loop->iteration }}</td>
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary">
                                    {{ $barang->kategori->NamaKategori ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $barang->NamaBarang }}</div>
                            </td>
                            <td>
                                <span class="fw-bold text-success">Rp {{ number_format($barang->Harga, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                @if($barang->Stock > 10)
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    {{ $barang->Stock }}
                                </span>
                                @elseif($barang->Stock > 0)
                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                    {{ $barang->Stock }}
                                </span>
                                @else
                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                    Habis
                                </span>
                                @endif
                            </td>
                            <td>
                                @if($barang->Foto)
                                <div class="position-relative" style="width: 60px; height: 60px;">
                                    <img src="/foto_barang/{{ $barang->Foto }}" 
                                         class="rounded object-fit-cover border"
                                         alt="{{ $barang->NamaBarang }}"
                                         style="width: 100%; height: 100%;"
                                         data-bs-toggle="tooltip"
                                         data-bs-title="Klik untuk memperbesar">
                                </div>
                                @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                                @endif
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 200px;" 
                                     data-bs-toggle="tooltip" 
                                     data-bs-title="{{ $barang->Deskripsi }}">
                                    {{ $barang->Deskripsi }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2 pe-4">
                                    <!-- Edit Link -->
                                    <a href="{{ route('barangs.edit', $barang->BarangID) }}" 
                                        class="btn btn-sm btn-outline-primary">
                                         <i class="fas fa-edit me-1"></i>Edit
                                     </a>
                                     
                                    
                                    <!-- Delete Form - Mempertahankan struktur asli -->
                                    <form action="{{ route('barangs.destroy', $barang->BarangID) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin hapus data?')">
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
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid rounded" alt="">
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
    
    .badge {
        padding: 0.35em 0.65em;
        font-weight: 500;
    }
    
    .object-fit-cover {
        object-fit: cover;
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
        
        // Image modal functionality
        const images = document.querySelectorAll('img[src*="foto_barang"]');
        const modalImage = document.getElementById('modalImage');
        const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        
        images.forEach(img => {
            img.style.cursor = 'pointer';
            img.addEventListener('click', function() {
                modalImage.src = this.src;
                imageModal.show();
            });
        });
    });
</script>

@endsection