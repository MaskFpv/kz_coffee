<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CustomerExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Customer::all()->map(function ($customer) {
            return [
                'ID' => $customer->id,
                'Nama Pelanggan' => $customer->nama,
                'Email' => $customer->email,
                'Alamat' => $customer->alamat,
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
                $event->sheet->getColumnDimension('A')->setWidth(5); //no
                $event->sheet->getColumnDimension('B')->setAutoSize(True); //nama 
                $event->sheet->getColumnDimension('C')->setAutoSize(True); //email
                $event->sheet->getColumnDimension('D')->setAutoSize(True); //alamat

                //judul atas
                $event->sheet->insertNewRowBefore(1, 3);
                $event->sheet->mergeCells('A1:D1');
                $event->sheet->mergeCells('A2:D2');
                $event->sheet->setCellValue('A1', "DATA PELANGGAN");
                $event->sheet->SetCellValue('A2', "PER TANGGAL " . date('d M Y'));

                //style
                $event->sheet->getStyle('A1:A2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                $event->sheet->getStyle('A1:B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A2:B2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                //border
                $event->sheet->getStyle('A4:D' . $event->sheet->getHighestRow())->ApplyFromArray([
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
            'ID',
            'Nama Pelanggan',
            'Email',
            'Alamat',
        ];
    }

    /**
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:D1' => ['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '00FF00']]],
        ];
    }
}
