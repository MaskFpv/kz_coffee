<div>
    <div class="container-fluid">
        <div class="row">
            <div class="left col-lg-8">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-left">
                        <h2>List Menu</h2>
                    </div>
                    <div class="text-right w-50">
                        <div class="input-group">
                            <span class="input-group-text bi bi-search"></span>
                            <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                                aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <div class="category mt-2">
                        <h5>Kategori</h5>
                        <div class="d-flex flex-wrap mt-3">
                            @foreach ($categories as $category)
                                <span class="mr-2">
                                    <button wire:key='category-{{ $category->id }}'
                                        wire:click="changeCategory({{ $category->id }})" type="button"
                                        class="btn btn-{{ $kategori_id == $category->id ? 'primary' : 'outline-primary' }} mb-2">
                                        {{ $category->nama }}
                                    </button>
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="type mt-3">
                        <h5>Tipe Menu</h5>
                        <div class="d-flex flex-wrap mt-3">
                            @if ($types)
                                @if ($types->isEmpty())
                                    <p class="text-danger">Jenis tidak ada</p>
                                @else
                                    @foreach ($types as $type)
                                        <span class="mr-2">
                                            <button wire:key='type-{{ $type->id }}' type="button"
                                                wire:click="changeType({{ $type->id }})"
                                                class="btn btn-{{ $type_id == $type->id ? 'primary' : 'outline-primary' }} mb-2">
                                                {{ $type->nama_jenis }}
                                            </button>
                                        </span>
                                    @endforeach
                                @endif
                            @else
                                <p class="text-info">Pilih kategori</p>
                            @endif
                        </div>
                    </div>
                </div>



                <hr>
                <div class="list-menu row">
                    @if ($menus->isEmpty())
                        <div class="d-flex gap-3 justify-content-center text-center mt-5">
                            <span class="bi bi-search"></span>
                            <p>Produk Tidak ada</p>
                        </div>
                    @else
                        @foreach ($menus as $item)
                            <div wire:key="menu-{{ $item->id }}" class="col-4 d-flex justify-content-between gap-2">
                                <div class="card mt-3 items-center"
                                    style="width: 18rem; border-radius: 15px; cursor: {{ $item->stocks->first() && $item->stocks->first()->jumlah > 0 ? 'pointer' : 'not-allowed' }};"
                                    @if ($item->stocks->first() && $item->stocks->first()->jumlah > 0) wire:click='pilihMenu({{ $item->id }})' @endif>
                                    <div class="card-header bg-white" style="border-radius: 15px;">
                                        {{ $item->type->nama_jenis }}</div>

                                    {{-- img --}}
                                    <div class="card-img-container mt-2" align="center"
                                        style="overflow: hidden; border-radius: 10px; padding: 10px;">
                                        <img src="{{ $item->photo ? \Storage::url($item->photo) : '' }}"
                                            class="card-img-top img-fluid"
                                            style="width: 120px; height: 120px; object-fit: cover; border-radius: 20px; border: 4px solid #bababa;"
                                            alt="{{ $item->nama }}" />
                                    </div>
                                    {{-- judul menu --}}

                                    <div class="card-title fw-semibold text-center mt-2 mb-0">
                                        {{ $item->nama }}
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            @if ($item->stocks->first() && $item->stocks->first()->jumlah > 0)
                                                <p class="text-left mb-0">Stok :
                                                    {{ $item->stocks->first()->jumlah }}</p>
                                            @else
                                                <p class="text-danger text-left mb-0">Stok : Habis</p>
                                            @endif
                                            <p class="text-right mb-0">Rp.
                                                {{ number_format($item->harga, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="paginate d-flex justify-content-center mt-5">
                    {{ $menus->links() }}
                </div>
            </div>
            <div class="right col-lg-4">
                <div class="card vh-100">
                    <div class="m-3 d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Pesanan Anda</h3>
                        @if (count($produk_detail) != 0)
                            <button data-bs-toggle="modal" data-bs-target="#modalDelete" type="button"
                                class="btn btn-light text-danger">
                                <i class="icon ion-md-trash"></i>
                            </button>
                        @endif
                    </div>

                    <hr class="m-0">
                    <div class="produk-detail h-100 px-4 py-2 mt-3 overflow-auto">
                        @foreach ($produk_detail as $item)
                            <div wire:key='product_detail-{{ $item['id'] }}' class="card py-3 px-4"
                                style="border-radius: 10px;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="p">
                                        <div>
                                            <h5>{{ $item['name'] }}</h5>
                                        </div>
                                        <div>Rp. {{ number_format($item['sub_total'], 0, ',', '.') }}</div>
                                    </div>
                                    <div class="qtyControl d-md-flex gap-md-1">
                                        <a type="button" wire:click='decreaseQuantity({{ $item['id'] }})'
                                            class="bi bi-dash-circle" style="color: red;"></a>
                                        <p class="text-muted m-0 ">{{ $item['quantity'] }}</p>
                                        <a type="button" wire:click='increaseQuantity({{ $item['id'] }})'
                                            class="bi bi-plus-circle" style="color: green;"></a>
                                    </div>
                                </div>
                                @if ($item['id'] === $stokHabis)
                                    <p wire:poll.1s="hideStockMessage" class="text-danger m-0">
                                        Stok Habis!</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer bg-white">
                        @if (count($produk_detail) != 0)
                            <div class="total d-flex justify-content-between fw-bolder fs-6 mb-2">
                                <p>Total :</p>
                                <p>Rp. {{ number_format($total_price, 0, ',', '.') }}</p>
                            </div>
                            <button data-bs-toggle="modal" wire:click='setupNoFaktur()' data-bs-target="#modalCheckout"
                                type="button" class="btn btn-success w-100 text-center">Checkout</button>
                        @else
                            <div class="text-center text-info p-3">Masukkan pesanan anda</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.transaction.modal')
</div>
