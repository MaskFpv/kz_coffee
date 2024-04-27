<?php

namespace App\Http\Controllers;

use App\Exports\StockExport;
use App\Models\Menu;
use App\Models\Stock;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StockStoreRequest;
use App\Http\Requests\StockUpdateRequest;
use App\Imports\StockImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Stock::class);

        $stocks = Stock::latest()->get();

        return view('app.stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Stock::class);

        // // Mengambil semua menu yang belum memiliki stok
        // $menus = Menu::whereNotIn('id', function ($query) {
        //     $query->select('menu_id')->from('stocks');
        // })->pluck('nama', 'id');

        $menus = Menu::pluck('nama', 'id');

        return view('app.stocks.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StockStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Stock::class);

        $validated = $request->validated();

        // Check if menu with the given ID already exists in the stocks table
        $existingStock = Stock::where('menu_id', $validated['menu_id'])->first();

        if ($existingStock) {
            // Jika menu sudah ada, berikan pesan error dan redirect kembali ke halaman sebelumnya
            return redirect()->route('stocks.index')->withErrors(__('crud.common.ada'));
        }

        $stock = Stock::create($validated);

        return redirect()
            ->route('stocks.index', $stock)
            ->with('success', 'Stok berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Stock $stock)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Stock $stock): View
    {
        $this->authorize('update', $stock);

        // // Mengambil semua menu yang belum memiliki stok atau memiliki stok yang sama dengan yang sedang diedit
        // $menus = Menu::whereNotIn('id', function ($query) use ($stock) {
        //     $query->select('menu_id')->from('stocks')->where('id', '!=', $stock->id);
        // })->pluck('nama', 'id');


        $menus = Menu::pluck('nama', 'id');

        return view('app.stocks.edit', compact('stock', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        StockUpdateRequest $request,
        Stock $stock
    ): RedirectResponse {
        $this->authorize('update', $stock);

        $validated = $request->validated();

        // Check if menu with the updated ID already exists in the stocks table
        $existingStock = Stock::where('menu_id', $validated['menu_id'])
            ->where('id', '!=', $stock->id) // Exclude the current stock being updated
            ->first();

        if ($existingStock) {
            // If menu already exists, give an error message and redirect back
            return redirect()
                ->route('stocks.index')
                ->withErrors(__('crud.common.ada'));
        }

        $stock->update($validated);

        return redirect()
            ->route('stocks.index', $stock)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Stock $stock): RedirectResponse
    {
        $this->authorize('delete', $stock);

        $stock->delete();

        return redirect()
            ->route('stocks.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function export()
    {
        return Excel::download(new StockExport, date('Ymd') . '__Stok.xlsx');
    }

    public function exportpdf()
    {
        $stocks = Stock::all();
        $pdf = Pdf::loadView('app.stocks.data', compact('stocks'));
        return $pdf->download('stock.pdf');
    }

    public function import(Request $request)
    {
        try {
            $file = request()->file('file');

            // Check if file was uploaded
            if (!$file) {
                throw new \Exception('Tidak ada File');
            }

            Excel::import(new StockImport(), $file);

            return redirect(route('stocks.index'))->withSuccess(__('crud.common.import'));
        } catch (\Exception $e) {
            // Handle any exceptions that occurred during the import process
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
