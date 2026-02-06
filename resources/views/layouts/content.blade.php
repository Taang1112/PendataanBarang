<main class="app-main">

    <!-- HEADER -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="app-content">
        <div class="container-fluid">

            <!-- ================= BOX ================= -->
            <div class="row">

                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-primary">
                        <div class="inner">
                            <h3>{{ $totalBarang }}</h3>
                            <p>Total Barang</p>
                        </div>
                        <a href="{{ url('/barangs') }}" class="small-box-footer link-light">
                            Lihat Data <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3>{{ $totalKategori }}</h3>
                            <p>Total Kategori</p>
                        </div>
                        <a href="{{ url('/kategoris') }}" class="small-box-footer link-light">
                            Lihat Data <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-info">
                        <div class="inner">
                            <h3>{{ $totalSupplier }}</h3>
                            <p>Total Supplier</p>
                        </div>
                        <a href="{{ url('/suppliers') }}" class="small-box-footer link-light">
                            Lihat Data <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3>{{ $totalStok }}</h3>
                            <p>Total Stok Barang</p>
                        </div>
                        <a href="{{ url('/barangs') }}" class="small-box-footer link-dark">
                            Detail <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <h3>Rp {{ number_format($totalNilai,0,',','.') }}</h3>
                            <p>Total Nilai Barang</p>
                        </div>
                        <a href="#" class="small-box-footer link-light">
                            Info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- BARANG MASUK -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3>{{ $masukHariIni }}</h3>
                            <p>Barang Masuk Hari Ini</p>
                        </div>
                        <a href="{{ url('/barang-masuk') }}" class="small-box-footer link-light">
                            Detail <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- BARANG KELUAR -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <h3>{{ $keluarHariIni }}</h3>
                            <p>Barang Keluar Hari Ini</p>
                        </div>
                        <a href="{{ url('/barang-keluar') }}" class="small-box-footer link-light">
                            Detail <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

            </div>

            <!-- ================= CHART ================= -->
            <div class="row mt-4">
                <div class="col-lg-7">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Grafik Barang per Kategori</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="kategoriChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card text-white bg-primary mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Info Sistem</h3>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>Total Barang: {{ $totalBarang }}</li>
                                <li>Total Supplier: {{ $totalSupplier }}</li>
                                <li>Total Stok: {{ $totalStok }}</li>
                                <li>Barang Masuk Hari Ini: {{ $masukHariIni }}</li>
                                <li>Barang Keluar Hari Ini: {{ $keluarHariIni }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<!-- ================= SCRIPT ================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($grafikKategori->pluck('NamaKategori'));
    const data   = @json($grafikKategori->pluck('total'));

    new Chart(document.getElementById('kategoriChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Barang',
                data: data,
                backgroundColor: '#0d6efd'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
