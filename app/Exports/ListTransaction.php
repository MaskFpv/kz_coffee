<?php

namespace App\Exports;

use App\Models\Transaction; // Menggunakan model Transaction
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ListTransaction implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Transaction::orderBy('id', 'desc')->get()->map(function ($transaction) {
            return [
                'No Faktur' => $transaction->id,
                'Tanggal Transaksi' => $transaction->date,
                'Pelanggan' => $transaction->customer->name,
                'Metode Pembayaran' => $transaction->payment_method,
                'Keterangan Pembelian' => $transaction->keterangan,
                'Total Pembayaran' => $transaction->total_price,
            ];
        });
    }

    /**
     * @return string
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setWidth(15); // No Faktur
                $event->sheet->getColumnDimension('B')->setAutoSize(True); // Tanggal Transaksi
                $event->sheet->getColumnDimension('C')->setAutoSize(True); // Pelanggan
                $event->sheet->getColumnDimension('D')->setAutoSize(True); // Metode Pembayaran
                $event->sheet->getColumnDimension('E')->setAutoSize(True); // Keterangan Pembelian
                $event->sheet->getColumnDimension('F')->setAutoSize(True); // Total Pembayaran
                // Judul atas
                $event->sheet->insertNewRowBefore(1, 3);
                $event->sheet->mergeCells('A1:F1');
                $event->sheet->mergeCells('A2:F2');
                $event->sheet->setCellValue('A1', "DATA LIST TRANSAKSI");
                $event->sheet->SetCellValue('A2', "PER TANGGAL " . date('d M Y'));

                // Style
                $event->sheet->getStyle('A1:A2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                $event->sheet->getStyle('A1:F1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A2:F2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                // Border
                $event->sheet->getStyle('A4:F' . $event->sheet->getHighestRow())->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);
            }
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No Faktur',
            'Tanggal Transaksi',
            'Pelanggan',
            'Metode Pembayaran',
            'Keterangan Pembelian',
            'Total Pembayaran',
        ];
    }

    /**
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:F1' => ['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '00FF00']]],
        ];
    }
}
