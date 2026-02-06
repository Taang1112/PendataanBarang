@extends('dashboard')

@section('content')
<div class="container-fluid px-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Data Barang Masuk</h1>
            <p class="text-muted">Catatan barang masuk dari supplier</p>
        </div>
        @if(auth()->user()->role === 'supplier')
        <a href="{{ route('barang-masuk.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-2"></i>Tambah Barang Masuk
        </a>
        @endif
    </div>

    <form method="GET" class="p-3">
        <div class="row g-2 mb-2">
            <div class="col-md-3">
                <input type="date" name="tanggal" class="form-control"
                       value="{{ request('tanggal') }}">
            </div>
        </div>
    
        <div class="input-group">
            <input type="text" name="search" class="form-control"
                   placeholder="Cari barang / supplier..."
                   value="{{ request('search') }}">
            <button class="btn btn-primary">Search</button>
        </div>
    </form>
    

    {{-- LAPORAN BUTTON --}}
    <form method="GET" action="{{ route('barang-masuk.pdf') }}" class="px-3 pb-3">
        <div class="d-flex gap-2 flex-wrap">
            <input type="date" name="dari" required class="form-control w-auto">
            <input type="date" name="sampai" required class="form-control w-auto">

            <button class="btn btn-danger">
                <i class="fas fa-file-pdf me-1"></i> PDF
            </button>

            <a id="excelMasukBtn" class="btn btn-success text-white">
                <i class="fas fa-file-excel me-1"></i> Excel
            </a>
        </div>
    </form>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
    </div>
    @endif

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Barang</th>
                            <th>Supplier</th>
                            <th>Jumlah</th>
                            <th>Tanggal Masuk</th>
                            <th>Keterangan</th>
                            @if(auth()->user()->role === 'supplier')
                            <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                        <tr>
                            <td class="ps-4">{{ $loop->iteration }}</td>
                            <td>{{ $item->barang->NamaBarang }}</td>
                            <td>{{ $item->supplier->NamaSupplier }}</td>
                            <td>{{ $item->JumlahMasuk }} pcs</td>
                            <td>{{ \Carbon\Carbon::parse($item->TanggalMasuk)->format('d M Y') }}</td>
                            <td>{{ $item->Keterangan ?: '-' }}</td>
                            @if(auth()->user()->role === 'supplier')
                            <td class="text-center">
                                <form action="{{ route('barang-masuk.destroy', $item->BarangMasukID) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">Belum ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
document.getElementById('excelMasukBtn').onclick = function(){
    const dari = document.querySelector('[name=dari]').value;
    const sampai = document.querySelector('[name=sampai]').value;
    window.location = `{{ route('barang-masuk.excel') }}?dari=${dari}&sampai=${sampai}`;
}
</script>
@endsection
