<?php

namespace App\Http\Controllers;

use App\Exports\CategoryExport;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Imports\CategoryImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Category::class);

        $categories = Category::latest()->get();

        return view('app.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Category::class);

        return view('app.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Category::class);

        $validated = $request->validated();

        $category = Category::create($validated);

        return redirect()
            ->route('categories.index', $category)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Category $category): View
    {
        $this->authorize('update', $category);

        return view('app.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CategoryUpdateRequest $request,
        Category $category
    ): RedirectResponse {
        $this->authorize('update', $category);

        $validated = $request->validated();

        $category->update($validated);

        return redirect()
            ->route('categories.index', $category)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Category $category
    ): RedirectResponse {
        $this->authorize('delete', $category);

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function export()
    {
        return Excel::download(new CategoryExport, date('Ymd') . '__Kategori.xlsx');
    }

    public function exportpdf()
    {
        $categories = Category::all();
        $pdf = Pdf::loadView('app.categories.data', compact('categories'));
        return $pdf->download('categories.pdf');
    }

    public function import(Request $request)
    {
        try {
            $file = request()->file('file');

            // Check if file was uploaded
            if (!$file) {
                throw new \Exception('Tidak ada File');
            }

            Excel::import(new CategoryImport(), $file);

            return redirect(route('categories.index'))->withSuccess(__('crud.common.import'));
        } catch (\Exception $e) {
            // Handle any exceptions that occurred during the import process
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    
}
