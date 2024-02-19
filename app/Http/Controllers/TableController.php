<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TableStoreRequest;
use App\Http\Requests\TableUpdateRequest;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Table::class);

        $search = $request->get('search', '');

        $tables = Table::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.tables.index', compact('tables', 'search'));
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
}
