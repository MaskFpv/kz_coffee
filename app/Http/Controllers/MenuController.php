<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Type;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\MenuStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\MenuUpdateRequest;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Menu::class);

        $search = $request->get('search', '');

        $menus = Menu::search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('app.menus.index', compact('menus', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Menu::class);

        $types = Type::pluck('nama_jenis', 'id');

        return view('app.menus.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Menu::class);

        $validated = $request->validated();
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('public');
        }

        $menu = Menu::create($validated);

        return redirect()
            ->route('menus.index', $menu)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Menu $menu): View
    {
        $this->authorize('view', $menu);

        return view('app.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Menu $menu): View
    {
        $this->authorize('update', $menu);

        $types = Type::pluck('nama_jenis', 'id');

        return view('app.menus.edit', compact('menu', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        MenuUpdateRequest $request,
        Menu $menu
    ): RedirectResponse {
        $this->authorize('update', $menu);

        $validated = $request->validated();
        if ($request->hasFile('photo')) {
            if ($menu->photo) {
                Storage::delete($menu->photo);
            }

            $validated['photo'] = $request->file('photo')->store('public');
        }

        $menu->update($validated);

        return redirect()
            ->route('menus.index', $menu)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Menu $menu): RedirectResponse
    {
        $this->authorize('delete', $menu);

        if ($menu->photo) {
            Storage::delete($menu->photo);
        }

        $menu->delete();

        return redirect()
            ->route('menus.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
