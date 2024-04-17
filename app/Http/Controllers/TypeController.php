<?php

namespace App\Http\Controllers;

use App\Exports\TypeExport;
use App\Models\Type;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TypeStoreRequest;
use App\Http\Requests\TypeUpdateRequest;
use App\Imports\TypeImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Type::class);

        $types = Type::latest()->get();

        return view('app.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Type::class);

        $categories = Category::pluck('nama', 'id');

        return view('app.types.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Type::class);

        $validated = $request->validated();

        $type = Type::create($validated);

        return redirect()
            ->route('types.index', $type)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Type $type)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Type $type): View
    {
        $this->authorize('update', $type);

        $categories = Category::pluck('nama', 'id');

        return view('app.types.edit', compact('type', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TypeUpdateRequest $request,
        Type $type
    ): RedirectResponse {
        $this->authorize('update', $type);

        $validated = $request->validated();

        $type->update($validated);

        return redirect()
            ->route('types.index', $type)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Type $type): RedirectResponse
    {
        $this->authorize('delete', $type);

        $type->delete();

        return redirect()
            ->route('types.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function exportpdf()
    {
        $types = Type::all();
        $pdf = Pdf::loadView('app.types.data', compact('types'));
        return $pdf->download('type.pdf');
    }

    public function export()
    {
        return Excel::download(new TypeExport, date('Ymd') . '__Jenis.xlsx');
    }

    public function import()
    {
        try {
            $file = request()->file('file');

            // Check if file was uploaded
            if (!$file) {
                throw new \Exception('Tidak Ada File');
            }

            Excel::import(new TypeImport(), $file);

            return redirect(route('types.index'))->withSuccess(__('crud.common.import'));
        } catch (\Exception $e) {
            // Handle any exceptions that occurred during the import process
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
