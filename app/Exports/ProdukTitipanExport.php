<?php

namespace App\Exports;

use App\Models\ProdukTitipan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProdukTitipanExport implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ProdukTitipan::all();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Daftar Produk Titipan';
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Id',
            'Nama Produk',
            'Nama Supplier',
            'Harga Beli',
            'Harga Jual',
            'Stok',
            '',
            'Created At',
            'Updated At',
        ];
    }

    /**
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true, 'size' => 12]],
            'A1:I1' => ['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '00FF00']]],
        ];
    }
}
