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

        $stock = Stock::create($validated);

        return redirect()
            ->route('stocks.index', $stock)
            ->withSuccess(__('crud.common.created'));
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
