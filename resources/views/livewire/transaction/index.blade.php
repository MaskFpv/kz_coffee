<div>
    <div>
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

                        <div class="category mt-2">
                            <h5>Kategori</h5>
                            <div class="d-flex justify-content-start mt-3">
                                @foreach ($categories as $category)
                                    <span>
                                        <button wire:key='category-{{ $category->id }}'
                                            wire:click="changeCategory({{ $category->id }})" type="button"
                                            class="btn btn-{{ $kategori_id == $category->id ? 'primary' : 'outline-primary' }} mr-2">
                                            {{ $category->nama }}
                                        </button>
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="type mt-3">
                            <h5>Tipe Menu</h5>
                            <div class="d-flex justify-content-start mt-3">
                                @if ($types)
                                    @if ($types->isEmpty())
                                        <p class="text-danger">Jenis tidak ada</p>
                                    @else
                                        @foreach ($types as $type)
                                            <button wire:key='type-{{ $type->id }}' type="button"
                                                wire:click="changeType({{ $type->id }})"
                                                class="btn btn-{{ $type_id == $type->id ? 'primary' : 'outline-primary' }} mr-2">
                                                {{ $type->nama_jenis }}
                                            </button>
                                        @endforeach
                                    @endif
                                @else
                                    <p class="text-info">Pilih kategori</p>
                                @endif
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
                                    <div wire:key="menu-{{ $item->id }}"
                                        class="col-3 d-flex justify-content-between gap-2">
                                        <div class="card mt-3 items-center" style="width:  15rem; border-radius: 10px">
                                            <div class="card-header">{{ $item->type->nama_jenis }}</div>
                                            <div class="card-title fw-semibold text-center mt-4 mb-0">
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
                                            <div class="card-footer text-center">
                                                @if ($item->stocks->first() && $item->stocks->first()->jumlah > 0)
                                                    <button wire:click='pilihMenu({{ $item->id }})'
                                                        class="btn btn-primary w-100">Tambahkan</button>
                                                @else
                                                    <button class="btn btn-danger w-100" disabled>Stok Habis</button>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            @endif
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
                            <div class="produk-detail h-100 px-3 py-2 mt-3 overflow-auto">
                                @foreach ($produk_detail as $item)
                                    <div wire:key='product_detail-{{ $item['id'] }}' class="card py-3 px-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <div>
                                                    <h5>{{ $item['name'] }}</h5>
                                                </div>
                                                <div>Rp. {{ number_format($item['sub_total'], 0, ',', '.') }}</div>
                                            </div>
                                            <div class="qtyControl d-md-flex gap-md-1">
                                                <a type="button" wire:click='decreaseQuantity({{ $item['id'] }})'
                                                    class="bi bi-dash-circle-fill"></a>
                                                <p class="text-muted m-0 ">{{ $item['quantity'] }}</p>
                                                <a type="button" wire:click='increaseQuantity({{ $item['id'] }})'
                                                    class="bi bi-plus-circle-fill"></a>
                                            </div>
                                        </div>
                                        @if ($item['id'] === $stokHabis)
                                            <p wire:poll.2s="hideStockMessage" wire:key="stokHabis"
                                                class="text-danger m-0">Stok Habis!</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div class="card-footer">
                                @if (count($produk_detail) != 0)
                                    <div class="total d-flex justify-content-between fw-bolder fs-6 mb-2">
                                        <p>Total :</p>
                                        <p>Rp. {{ number_format($total_price, 0, ',', '.') }}</p>
                                    </div>
                                    <button class="btn btn-primary w-100 text-center">Checkout</button>
                                @else
                                    <div class="text-center text-info p-3">Masukkan pesanan anda</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Modal delete --}}

    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="ClearTransactionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ClearTransactionModalLabel">Apakah anda yakin ingin menghapus semua
                        pesanan
                        anda?
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="button" data-bs-dismiss="modal" wire:click='clearPesan()'
                        class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>

</div>
