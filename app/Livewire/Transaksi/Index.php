<?php

namespace App\Livewire\Transaksi;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Stock;
use App\Models\Type;
use Livewire\Component;

class Index extends Component
{

    public function render()
    {
        $menus = Menu::all();
        $stocks = Stock::all();
        $categories = Category::all();
        $types = Type::all();
        $customers = Customer::all();

        return view('livewire.transaksi.menu', compact('menus', 'stocks', 'categories', 'types', 'customers'));
    }
}
