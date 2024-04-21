<?php

namespace App\Http\Controllers;

use App\Exports\CustomerExport;
use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Imports\CustomerImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Customer::class);

        $customers = Customer::latest()->get();

        return view('app.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Customer::class);

        return view('app.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Customer::class);

        $validated = $request->validated();

        $customer = Customer::create($validated);

        return redirect()
            ->route('customers.index', $customer)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Customer $customer)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Customer $customer): View
    {
        $this->authorize('update', $customer);

        return view('app.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CustomerUpdateRequest $request,
        Customer $customer
    ): RedirectResponse {
        $this->authorize('update', $customer);

        $validated = $request->validated();

        $customer->update($validated);

        return redirect()
            ->route('customers.index', $customer)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Customer $customer
    ): RedirectResponse {
        $this->authorize('delete', $customer);

        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function export()
    {
        return Excel::download(new CustomerExport, date('Ymd') . '__Pelanggan.xlsx');
    }

    public function exportpdf()
    {
        $customers = Customer::all();
        $pdf = Pdf::loadView('app.customers.data', compact('customers'));
        return $pdf->download('customers.pdf');
    }

    public function import(Request $request)
    {
        try {
            $file = request()->file('file');

            // Check if file was uploaded
            if (!$file) {
                throw new \Exception('Tidak ada File');
            }

            Excel::import(new CustomerImport(), $file);

            return redirect(route('customers.index'))->withSuccess(__('crud.common.import'));
        } catch (\Exception $e) {
            // Handle any exceptions that occurred during the import process
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
