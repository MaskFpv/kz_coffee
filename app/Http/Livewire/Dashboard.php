<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Menu;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $totalTransaksi;
    public $totalMenu;
    public $totalCustomer;
    public $topMenus;
    public $recentTransactions;
    public $lowStockMenus;
    public $totalOmset;
    public $omsetData = [];

    public function mount()
    {
        $this->totalTransaksi = Transaction::count();
        $this->totalMenu = Menu::count();
        $this->totalCustomer = Customer::count();
        $this->totalOmset = TransactionDetail::sum('sub_total');

        // Mendapatkan lima menu teratas yang paling banyak dibeli
        $this->topMenus = Menu::select('menus.*', \DB::raw('SUM(transaction_details.qty) as total_qty'))
            ->join('transaction_details', 'menus.id', '=', 'transaction_details.menu_id')
            ->groupBy('menus.id', 'menus.nama', 'menus.harga', 'menus.photo', 'menus.type_id', 'menus.created_at', 'menus.updated_at') // Include 'menus.updated_at' in the GROUP BY clause
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();

        // Mendapatkan lima menu dengan stok tersisa sedikit
        $this->lowStockMenus = Menu::select('menus.*', \DB::raw('COALESCE(SUM(stocks.jumlah), 0) as total_stock'))
            ->leftJoin('stocks', 'menus.id', '=', 'stocks.menu_id')
            ->groupBy('menus.id', 'menus.nama', 'menus.harga', 'menus.photo', 'menus.type_id', 'menus.created_at', 'menus.updated_at')
            ->havingRaw('total_stock <= ?', [10]) // Ubah ambang batas sesuai kebutuhan Anda
            ->orderByRaw('total_stock') // Urutkan berdasarkan stok tersisa dari yang terkecil
            ->limit(5)
            ->get();

        // Mendapatkan transaksi terbaru berserta detailnya
        $this->recentTransactions = TransactionDetail::select(
            'transactions.id',
            'transactions.created_at',
            DB::raw('SUM(transaction_details.qty * transaction_details.unit_price) AS total_harga')
        )
            ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->groupBy('transactions.id', 'transactions.created_at')
            ->orderByDesc('transactions.created_at')
            ->limit(5)
            ->get();

        // Inisialisasi array untuk tanggal dan omset
        $dates = [];
        $omsets = [];

        // Ambil data untuk 7 hari terakhir
        for ($i = 6; $i >= 0; $i--) {
            // Tentukan tanggal untuk hari tersebut
            $date = Carbon::today()->subDays($i)->toDateString();
            // Ambil omset untuk tanggal tersebut
            $omset = TransactionDetail::whereDate('created_at', $date)->sum('sub_total');
            // Tambahkan tanggal dan omset ke dalam array
            $dates[] = $date;
            $omsets[] = $omset;
        }
        // Simpan data tanggal dan omset ke dalam property Livewire
        $this->dates = $dates;
        $this->omsets = $omsets;
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'dates' => $this->dates,
            'omsets' => $this->omsets,
        ]);
    }
}
