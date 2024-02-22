<?php

namespace App\Http\Livewire\Transaction;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Stock;
use App\Models\Type;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Index extends Component
{
    // Menu List
    public Collection $types;

    public $search = '';
    public $kategori_id = 0;
    public $type_id = 0;

    // Pesan
    public $quantity = 0;
    public $produk_detail = [];


    public function render()
    {
        $categories = Category::all();
        $customers = Customer::all();

        if ($this->kategori_id != 0) {
            $type =  Type::where('category_id', $this->kategori_id)->get();
            $this->types = $type;
        }

        if ($this->type_id != 0) {
            $menus = Menu::where('nama', 'like', '%' . $this->search . '%')
                ->where('type_id', $this->type_id)
                ->simplePaginate(16);
        } else {
            $menus = Menu::where('nama', 'like', '%' . $this->search . '%')
                ->with('stocks')
                ->simplePaginate(16);
        }

        return view('livewire.transaction.index', compact('categories', 'menus', 'customers'));
    }


    public function changeCategory($id)
    {
        $this->kategori_id = $id;
        $this->type_id = 0;
    }


    public function changeType($id)
    {
        $this->type_id = $id;
    }

    //Penambahan ke pesan
    public function pilihMenu($id)
    {
        $produkIds = collect($this->produk_detail)->pluck('id');

        $menu = Menu::findOrFail($id);

        if ($produkIds->contains($id)) {
            $index = $produkIds->search($id);
            $this->produk_detail[$index]['qty']++;

            $this->subTotalChange($index);
        } else {
            $data = [
                'id' => $menu->id,
                'name' => $menu->nama,
                'price' => $menu->harga,
                'sub_total' => $menu->harga,
                'qty' => 1,
            ];

            $this->produk_detail[] = $data;
        }
    }

    public function clearPesan()
    {
        $this->produk_detail = [];
    }
}
