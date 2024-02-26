<?php

namespace App\Http\Livewire\Transaction;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Stock;
use App\Models\Type;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Termwind\Components\Dd;

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
    public $stokHabis;

    // Checkout
    public $total_price;


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

    /* --------------------------------------------------------------------------------- */


    public function changeCategory($id)
    {
        $this->kategori_id = $id;
        $this->type_id = 0;
    }


    public function changeType($id)
    {
        $this->type_id = $id;
    }

    /* --------------------------------------------------------------------------------- */

    //Penambahan ke pesan
    public function pilihMenu($id)
    {
        $produkIds = collect($this->produk_detail)->pluck('id');

        $menu = Menu::findOrFail($id);
        $stok = Stock::where('menu_id', $id)->first();

        if ($produkIds->contains($id)) {
            $index = $produkIds->search($id);

            if ($this->produk_detail[$index]['quantity'] >= $stok->jumlah) {
                $this->stokHabis = $id;
                $this->addError('stok-habis', "Stok tidak mencukupi");
            } else {

                $this->produk_detail[$index]['quantity']++;
            }

            $this->subTotalChange($index);
        } else {
            $data = [
                'id' => $menu->id,
                'name' => $menu->nama,
                'price' => $menu->harga,
                'sub_total' => $menu->harga,
                'quantity' => 1,
            ];

            $this->produk_detail[] = $data;
        }
        $this->getTotalHarga();
        $this->getTotalHarga();
    }


    public function subTotalChange($index)
    {

        $price =  $this->produk_detail[$index]['price'];
        $quantity = $this->produk_detail[$index]['quantity'];

        $this->produk_detail[$index]['sub_total'] = $price * $quantity;
    }

    public function clearPesan()
    {
        $this->produk_detail = [];
    }

    public function hideStockMessage()
    {
        $this->reset('stokHabis');
    }


    /* --------------------------------------------------------------------------------- */

    public function increaseQuantity($id)
    {
        $produkIds = collect($this->produk_detail)->pluck('id');
        $index = $produkIds->search($id);

        $stok = Stock::where('menu_id', $id)->first();


        if ($this->produk_detail[$index]['quantity'] >= $stok->jumlah) {
            $this->stokHabis = $id;
            $this->addError('stok-habis', "Stok tidak mencukupi");
        } else {
            $this->produk_detail[$index]['quantity']++;
        }

        $this->subTotalChange($index);
        $this->getTotalHarga();
    }

    public function decreaseQuantity($id)
    {
        $produkIds = collect($this->produk_detail)->pluck('id');
        $index = $produkIds->search($id);
        $this->produk_detail[$index]['quantity']--;

        if ($this->produk_detail[$index]['quantity'] <= 0) {
            unset($this->produk_detail[$index]);
            $this->produk_detail = array_values($this->produk_detail);
        } else {
            $this->subTotalChange($index);
        }
        $this->getTotalHarga();
    }

    /* --------------------------------------------------------------------------------- */

    public function getTotalHarga()
    {

        $totalPrice = 0;

        foreach ($this->produk_detail as $produk) {
            $subTotal =  $produk['sub_total'];
            $totalPrice += $subTotal;
        }

        $this->total_price = $totalPrice;
    }
}