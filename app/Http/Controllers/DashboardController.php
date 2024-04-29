<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $this->authorize('view-any', Stock::class);
        return view('app.dashboard.index');
    }
}
