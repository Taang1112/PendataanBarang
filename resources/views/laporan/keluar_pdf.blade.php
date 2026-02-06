<h2>Laporan Barang Keluar</h2>
<table border="1" width="100%" cellspacing="0" cellpadding="5">
    <tr>
        <th>Tanggal</th>
        <th>Barang</th>
        <th>Jumlah</th>
        <th>Keterangan</th>
    </tr>
    @foreach($data as $d)
    <tr>
        <td>{{ $d->TanggalKeluar }}</td>
        <td>{{ $d->barang->NamaBarang }}</td>
        <td>{{ $d->JumlahKeluar }}</td>
        <td>{{ $d->Keterangan }}</td>
    </tr>
    @endforeach
</table>
