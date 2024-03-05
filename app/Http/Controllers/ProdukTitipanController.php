<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ProdukTitipan;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProdukTitipanStoreRequest;
use App\Http\Requests\ProdukTitipanUpdateRequest;

class ProdukTitipanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ProdukTitipan::class);

        $produkTitipans = ProdukTitipan::latest()->paginate(5);

        return view('app.produk_titipans.index', compact('produkTitipans'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ProdukTitipan::class);

        return view('app.produk_titipans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdukTitipanStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ProdukTitipan::class);

        $validated = $request->validated();

        $produkTitipan = ProdukTitipan::create($validated);

        return redirect()
            ->route('produk-titipans.index', $produkTitipan)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ProdukTitipan $produkTitipan)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ProdukTitipan $produkTitipan): View
    {
        $this->authorize('update', $produkTitipan);

        return view('app.produk_titipans.edit', compact('produkTitipan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ProdukTitipanUpdateRequest $request,
        ProdukTitipan $produkTitipan
    ): RedirectResponse {
        $this->authorize('update', $produkTitipan);

        $validated = $request->validated();

        $produkTitipan->update($validated);

        return redirect()
            ->route('produk-titipans.index', $produkTitipan)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ProdukTitipan $produkTitipan
    ): RedirectResponse {
        $this->authorize('delete', $produkTitipan);

        $produkTitipan->delete();

        return redirect()
            ->route('produk-titipans.index')
            ->withSuccess(__('crud.common.removed'));
    }
}