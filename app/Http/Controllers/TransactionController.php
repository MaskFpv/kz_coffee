<?php

namespace App\Http\Controllers;

use App\Exports\ListTransaction;
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

        $transactions = Transaction::latest()->get();

        return view('app.transaction.data', compact('transactions'));
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
}
