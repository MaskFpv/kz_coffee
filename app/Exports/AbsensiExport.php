<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AbsensiExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Absensi::all()->map(function ($absensi) {
            return [
                'Nama Karyawan' => $absensi->nama_karyawan,
                'Tangal Masuk' => $absensi->tanggal_masuk,
                'Waktu Masuk' => $absensi->waktu_masuk,
                'Status' => $absensi->status,
                'Waktu Keluar' => $absensi->waktu_keluar,
            ];
        });
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setWidth(5);
                $event->sheet->getColumnDimension('B')->setAutoSize(True);
                $event->sheet->getColumnDimension('C')->setAutoSize(True);
                $event->sheet->getColumnDimension('D')->setAutoSize(True);
                $event->sheet->getColumnDimension('E')->setAutoSize(True);

                // Judul atas
                $event->sheet->insertNewRowBefore(1, 3);
                $event->sheet->mergeCells('A1:E1');
                $event->sheet->mergeCells('A2:E2');
                $event->sheet->setCellValue('A1', "DATA ABSENSI KARYAWAN");
                $event->sheet->SetCellValue('A2', "PER TANGGAL " . date('d M Y'));

                // Style
                $event->sheet->getStyle('A1:A2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                $event->sheet->getStyle('A1:E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A2:E2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                // Border
                $event->sheet->getStyle('A4:E' . $event->sheet->getHighestRow())->ApplyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' =>  \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
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
            'Nama Karyawan',
            'Tanggal Masuk',
            'Waktu Masuk',
            'Status',
            'Waktu Keluar',
        ];
    }

    /**
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:E1' => ['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '00FF00']]],
        ];
    }
}
