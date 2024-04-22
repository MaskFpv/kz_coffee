<?php

namespace App\Http\Controllers;

use App\Exports\TableExport;
use App\Models\Table;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TableStoreRequest;
use App\Http\Requests\TableUpdateRequest;
use App\Imports\TableImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Table::class);

        $tables = Table::latest()->get();

        return view('app.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Table::class);

        return view('app.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TableStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Table::class);

        $validated = $request->validated();

        $table = Table::create($validated);

        return redirect()
            ->route('tables.index', $table)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Table $table)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Table $table): View
    {
        $this->authorize('update', $table);

        return view('app.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TableUpdateRequest $request,
        Table $table
    ): RedirectResponse {
        $this->authorize('update', $table);

        $validated = $request->validated();

        $table->update($validated);

        return redirect()
            ->route('tables.index', $table)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Table $table): RedirectResponse
    {
        $this->authorize('delete', $table);

        $table->delete();

        return redirect()
            ->route('tables.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function export()
    {
        return Excel::download(new TableExport, date('Ymd') . '__Meja.xlsx');
    }

    public function exportpdf()
    {
        $tables = Table::all();
        $pdf = Pdf::loadView('app.tables.data', compact('tables'));
        return $pdf->download('tables.pdf');
    }

    public function import(Request $request)
    {
        try {
            $file = request()->file('file');

            // Check if file was uploaded
            if (!$file) {
                throw new \Exception('Tidak ada File');
            }

            Excel::import(new TableImport(), $file);

            return redirect(route('tables.index'))->withSuccess(__('crud.common.import'));
        } catch (\Exception $e) {
            // Handle any exceptions that occurred during the import process
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
