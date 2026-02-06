<?php

namespace App\Exports;

use App\Models\BarangKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BarangKeluarExport implements 
    FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return BarangKeluar::with('barang')->get();
    }

    public function headings(): array
    {
        return [
            ['LAPORAN BARANG KELUAR'],
            [],
            [
                'Nama Barang',
                'Jumlah Keluar',
                'Tanggal Keluar',
                'Keterangan'
            ]
        ];
    }

    public function map($row): array
    {
        return [
            $row->barang->NamaBarang ?? '-',
            $row->JumlahKeluar,
            date('d-m-Y', strtotime($row->TanggalKeluar)),
            $row->Keterangan ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 16]],
            3 => ['font' => ['bold' => true]],
        ];
    }
}
