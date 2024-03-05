<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $this->authorize('view-any', Transaction::class);
        return view('app.transaction.index');
    }

    public function nota_faktur($id)
    {
        $data = Transaction::findOrFail($id);

        return view('app.transaction.invoice', compact('data'));
    }
}
