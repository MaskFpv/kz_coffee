<?php

namespace App\Http\Livewire\Transaction;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Stock;
use App\Models\Type;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Termwind\Components\Dd;
use Mockery\Undefined;
use PHPUnit\TestRunner\TestResult\Collector;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert;


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
    public $no_faktur;
    public $date;
    public $payment_method;
    public $total_pembayaran;
    public $kembalian;
    public $keterangan;
    public $customer_id;


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
                ->simplePaginate(6);
        } else {
            $menus = Menu::where('nama', 'like', '%' . $this->search . '%')
                ->with('stocks')
                ->simplePaginate(6);
        }

        return view('livewire.transaction.index', compact('categories', 'menus', 'customers', 'customers'));
    }


    /* --------------------------------------------------------------------------------- */

    // Kategori
    public function changeCategory($id)
    {
        $this->kategori_id = $id;
        $this->type_id = 0;
    }

    // jenis
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
                'photo' => $menu->photo,
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

    // Method menghitung jumlah subtotal dari produk_detail
    public function subTotalChange($index)
    {

        $price =  $this->produk_detail[$index]['price'];
        $quantity = $this->produk_detail[$index]['quantity'];

        $this->produk_detail[$index]['sub_total'] = $price * $quantity;
    }

    // Tombol hapus dari Produk Detail
    public function clearPesan()
    {
        $this->produk_detail = [];
    }

    // Stok habis di produk detail
    public function hideStockMessage()
    {
        $this->reset('stokHabis');
    }


    /* --------------------------------------------------------------------------------- */


    // Menambahkan kuantitas di Produk_detail
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


    // Mengurangi kuantitas di produk_detail
    public function decreaseQuantity($id)
    {
        $produkIds = collect($this->produk_detail)->pluck('id');
        $index = $produkIds->search($id);

        if ($index !== false && array_key_exists($index, $this->produk_detail)) {
            $this->produk_detail[$index]['quantity']--;

            if ($this->produk_detail[$index]['quantity'] <= 0) {
                unset($this->produk_detail[$index]);
                $this->produk_detail = array_values($this->produk_detail);
            } else {
                $this->subTotalChange($index);
            }
        }
        // dd($this->produk_detail);
        $this->getTotalHarga();
    }

    /* --------------------------------------------------------------------------------- */

    // Mengambil
    public function getTotalHarga()
    {

        $totalPrice = 0;

        foreach ($this->produk_detail as $produk) {
            $subTotal =  $produk['sub_total'];
            $totalPrice += $subTotal;
        }

        $this->total_price = $totalPrice;
    }

    // Kembalian
    public function functionKembalian()
    {

        if ($this->total_pembayaran >= $this->total_price) {
            $totalKembalian = $this->total_pembayaran - $this->total_price;
            $this->kembalian = $totalKembalian;
        } else {
            $this->kembalian = 'Pembayaran Kurang!';
        }
    }

    // Function untuk Generate Nomor faktur
    public function generateCustomId()
    {
        $today = now()->format('Ymd');
        $lastCustomId = Transaction::where('date', $today)->orderBy('id', 'desc')->first();



        if ($lastCustomId) {
            $lastId = substr($lastCustomId->id, -4);
            $newId = $today . str_pad((intval($lastId) + 1), 4, '0', STR_PAD_LEFT);
        } else {
            $newId = $today . '0001';
        }

        return $newId;
    }

    // Funtion untuk memanggil Nomor Faktur
    public function setupNoFaktur()
    {

        $this->getTotalHarga();

        $no_faktur = $this->generateCustomId();

        $this->no_faktur = $no_faktur;
    }

    /* --------------------------------------------------------------------------------- */


    // Function Checkout
    public function checkout()
    {
        $rules = [
            'date' => 'required|date',
            'total_price' => 'required|numeric',
            'payment_method' => 'required|in:cash,debit',
            'keterangan' => 'required|string',
            'customer_id' => 'required|exists:customers,id',
        ];

        if ($this->payment_method == 'cash') {
            $rules['total_pembayaran'] = 'required|numeric|min:' . $this->total_price;
        }

        $this->validate($rules);

        $transactionData = [
            'id' => $this->no_faktur,
            'date' => $this->date,
            'total_price' => $this->total_price,
            'payment_method' => $this->payment_method,
            'keterangan' => $this->keterangan,
            'customer_id' => $this->customer_id
        ];

        Transaction::create($transactionData);

        foreach ($this->produk_detail as $produk) {
            $subtractQty = $produk['quantity'];


            DB::beginTransaction();
            try {
                $transactionDetailData = [
                    'menu_id' => $produk['id'],
                    'transaction_id' => $this->no_faktur,
                    'qty' => $produk['quantity'],
                    'unit_price' => $produk['price'],
                    'sub_total' => $produk['sub_total']
                ];


                TransactionDetail::create($transactionDetailData);

                Stock::where('menu_id', $produk['id'])->update([
                    'jumlah' => DB::raw("jumlah - $subtractQty")
                ]);

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }


        $this->alert('success', 'Transaksi Berhasil', [
            'position' => 'center',
            'toast' => true,
            'timer' => 9999999,
            'showConfirmButton' => true,
            'onConfirmed' => "transactionDialogTrue",
            'confirmButtonText' => 'Nota Faktur',
            'showCancelButton' => true,
            'onDismissed' => "onOk",
            'cancelButtonText' => 'Ok',
            'onClose' => 'onOk',

        ]);
    }

    // 
    protected function getListeners()
    {
        return ['onOk' => 'redirectToIndex', 'transactionDialogTrue' => 'transactionDialogTrue'];
    }

    // Jika nota transaction dialog true nya di pencet
    public function transactionDialogTrue()
    {
        $no_faktur = $this->no_faktur;
        return redirect()->to("transaction/invoice/{$no_faktur}");
    }

    // Return redirect setelah dari nota faktur
    public function redirectToIndex()
    {
        return redirect()->route('transaction.index');
    }
}
