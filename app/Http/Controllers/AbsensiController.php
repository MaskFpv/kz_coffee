<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiExport;
use App\Models\Absensi;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AbsensiStoreRequest;
use App\Http\Requests\AbsensiUpdateRequest;
use App\Imports\AbsensiImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Absensi::class);

        $absensis = Absensi::latest()->get();

        return view('app.absensis.index', compact('absensis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Absensi::class);

        return view('app.absensis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AbsensiStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Absensi::class);

        $validated = $request->validated();

        $absensi = Absensi::create($validated);

        return redirect()
            ->route('absensis.index', $absensi)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Absensi $absensi)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Absensi $absensi): View
    {
        $this->authorize('update', $absensi);

        return view('app.absensis.edit', compact('absensi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AbsensiUpdateRequest $request,
        Absensi $absensi
    ): RedirectResponse {
        $this->authorize('update', $absensi);

        $validated = $request->validated();

        $absensi->update($validated);

        return redirect()
            ->route('absensis.index', $absensi)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Absensi $absensi
    ): RedirectResponse {
        $this->authorize('delete', $absensi);

        $absensi->delete();

        return redirect()
            ->route('absensis.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function export()
    {
        return Excel::download(new AbsensiExport, date('Ymd') . '__Abensi.xlsx');
    }

    public function exportpdf()
    {
        $absensis = Absensi::all();
        $pdf = Pdf::loadView('app.absensis.data', compact('absensis'));
        return $pdf->download('absensi.pdf');
    }

    public function import()
    {
        try {
            $file = request()->file('file');

            // Check if file was uploaded
            if (!$file) {
                throw new \Exception('Tidak ada File');
            }

            Excel::import(new AbsensiImport(), $file);

            return redirect(route('absensis.index'))->withSuccess(__('crud.common.import'));
        } catch (\Exception $e) {
            // Handle any exceptions that occurred during the import process
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
