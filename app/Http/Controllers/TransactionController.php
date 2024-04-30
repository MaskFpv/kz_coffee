<?php

namespace App\Http\Controllers;

use App\Exports\ListTransaction;
use App\Models\laporan;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    public function index()
    {
        $this->authorize('view-any', Transaction::class);
        return view('app.transaction.index');
    }

    public function listTransaksi()
    {
        $this->authorize('view-any', Transaction::class);

        $transactions = Transaction::latest('date')->get();

        return view('app.transaction.data', compact('transactions'));
    }

    public function laporan()
    {
        $this->authorize('view', laporan::class);
        return view('app.transaction.laporan');
    }

    public function nota_faktur($id)
    {
        $data = Transaction::findOrFail($id);

        return view('app.transaction.invoice', compact('data'));
    }

    public function export()
    {
        return Excel::download(new ListTransaction, date('Ymd') . '__List-Transaksi.xlsx');
    }

    public function exportpdf()
    {

        $data = Transaction::latest()->get();

        $pdf = Pdf::loadView('app.transaction.list', compact('data'));

        return $pdf->download('transaction.pdf');
    }

    public function exportLaporan($awal, $akhir)
    {
        $data_laporan = Transaction::whereBetween('date', [$awal, $akhir]);

        $laporan = $data_laporan->get();
        $total_pendapatan = $data_laporan->sum('total_price');

        $tanggalAwal = date('d-m-Y', strtotime($awal));
        $tanggalAkhir = date('d-m-Y', strtotime($akhir));

        $pdf = Pdf::loadView('app.transaction.pdf', compact('laporan', 'total_pendapatan', 'tanggalAwal', 'tanggalAkhir'))
            ->setPaper('a4', 'landscape');

        // Download the PDF file with the specified name
        return $pdf->download("Laporan Tanggal " . date('d-m-Y') . ".pdf");
    }
}
