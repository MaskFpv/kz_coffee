{{-- Modal delete --}}

<div class="modal fade" wire:ignore.self id="modalDelete" tabindex="-1" aria-labelledby="ClearTransactionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ClearTransactionModalLabel">Apakah anda yakin ingin menghapus
                    semua
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

{{-- Modal Checkout --}}

<div class="modal fade vh-100" wire:ignore.self id="modalCheckout" tabindex="-1" aria-labelledby="modalCheckoutLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form wire:submit="checkout">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="modalCheckoutLabel">Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="top-input d-md-flex justify-content-between mt-2">
                        <p>
                            No Faktur : {{ $no_faktur }}
                        </p>
                        <div class="customer">
                            <select class="form-select form-select-sm" style="width: 250px"
                                aria-label=".form-select-sm example">
                                <option selected>Pilih Customer</option>
                                @foreach ($customers as $pelanggan)
                                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- List dari produk detail --}}
                    <div class="border-1 border border-info rounded overflow-hidden mt-3">
                        <div class="list overflow-auto" style="height: 15em">
                            @foreach ($produk_detail as $item)
                                <div wire:key='product_details-{{ $item['id'] }}' class="card mb-2 p-2">
                                    <div class="product d-flex align-items-center">
                                        <img class="m-2"
                                            src="{{ $item['photo'] ? \Storage::url($item['photo']) : '' }}"
                                            style="width:50px; height: 50px; object-fit: cover"
                                            alt="{{ $item['name'] }}" />
                                        <div class="detail w-100 d-flex justify-content-between align-items-center">
                                            <div class="info d-flex justify-content-between align-items-center w-100">
                                                <p class=" m-0 fw-bolder px-2">
                                                    {{ $item['name'] }} x {{ $item['quantity'] }}
                                                </p>
                                                <p class="m-0 px-2" style="font-weight: bold">
                                                    Rp. {{ number_format($item['sub_total'], 0, ',', '.') }}
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- input tanggal dan tipe pembayarannya --}}
                    <div class="detail p-2 d-flex flex-row justify-content-end gap-3 mt-3">
                        <div class="w-50">
                            <select wire:model.lazy="payment_method" name="payment_method"
                                class="form-select form-select-sm h-100 @error('payment_method') is-invalid @enderror">
                                <option selected>Pilih Tipe Pembayaran</option>
                                <option value="cash">Tunai</option>
                                <option value="debit">Debit</option>
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="w-50">
                            <input type="date" name="date"
                                class="form-control h-100 @error('date') is-invalid @enderror" wire:model.live='date'
                                value="{{ now()->format('m-d-Y') }}" max="{{ date('Y-m-d') }}"
                                min="{{ date('Y-m-d') }}">
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- membuat pengecekan apabila pembayaran nya cash --}}
                    @if ($payment_method == 'cash')
                        <div class="mb-3 mt-2">
                            <label for="total_pembayaran" class="form-label">Bayar</label>
                            <input type="number" name="total_pembayaran" wire:change="functionKembalian()"
                                wire:model.lazy='total_pembayaran'
                                class="form-control @error('total_pembayaran') is-invalid @enderror">
                            @error('total_pembayaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    {{-- keterangan --}}
                    <div class="mb-3 mt-2">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" wire:model.lazy='keterangan'
                            id="keterangan" cols="30" rows="5"></textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Subtotal dan kembalian --}}
                <div class="totalAndKembalian p-3">
                    <div class="total d-flex  justify-content-between align-items-center">
                        <h5>Total:</h5>
                        <input type="text" hidden name="total_price" value="{{ $total_price }}">
                        <h5>Rp. {{ $total_price }}</h5>
                    </div>
                    @if ($payment_method == 'cash')
                        <div class="total d-flex  justify-content-between align-items-center">
                            <h5>Kembalian:</h5>
                            @if (!is_string($kembalian))
                                <h5>Rp. {{ $kembalian }}</h5>
                            @else
                                <h5 class="text-danger"> {{ $kembalian }}</h5>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success w-100 text-center">Bayar</button>
                </div>
            </div>
        </form>
    </div>
</div>
