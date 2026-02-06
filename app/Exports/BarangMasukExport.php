<?php

namespace App\Exports;

use App\Models\BarangMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BarangMasukExport implements 
    FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return BarangMasuk::with(['barang','supplier'])->get();
    }

    public function headings(): array
    {
        return [
            ['LAPORAN BARANG MASUK'],
            [],
            [
                'Nama Barang',
                'Kode Barang',
                'Supplier',
                'Jumlah Masuk',
                'Tanggal Masuk',
                'Keterangan'
            ]
        ];
    }

    public function map($row): array
    {
        return [
            $row->barang->NamaBarang ?? '-',
            $row->barang->KodeBarang ?? '-',
            $row->supplier->NamaSupplier ?? '-',
            $row->JumlahMasuk,
            date('d-m-Y', strtotime($row->TanggalMasuk)),
            $row->Keterangan ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 16]], // Judul
            3 => ['font' => ['bold' => true]], // Header tabel
        ];
    }
}
