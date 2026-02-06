<h2>Laporan Barang Masuk</h2>
<table border="1" width="100%" cellspacing="0" cellpadding="5">
    <tr>
        <th>Tanggal</th>
        <th>Barang</th>
        <th>Supplier</th>
        <th>Jumlah</th>
    </tr>
    @foreach($data as $d)
    <tr>
        <td>{{ $d->TanggalMasuk }}</td>
        <td>{{ $d->barang->NamaBarang }}</td>
        <td>{{ $d->supplier->NamaSupplier }}</td>
        <td>{{ $d->JumlahMasuk }}</td>
    </tr>
    @endforeach
</table>
