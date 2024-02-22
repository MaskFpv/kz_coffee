<div>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="left col-md-8">
                    <h2>List Menu</h2>
                    <hr>
                    <div class="category mt-2">
                        <h5>Kategori</h5>
                        <div class="d-flex justify-content-start mt-3">
                            <button type="button" class="btn btn-primary mr-2">Makanan</button>
                        </div>
                    </div>
                    <div class="type mt-3">
                        <h5>Tipe Menu</h5>
                        <div class="d-flex justify-content-start mt-3">
                            <button type="button" class="btn btn-primary mr-2">Makanan Berat</button>
                            <button type="button" class="btn btn-primary">Makanan Ringan</button>
                        </div>
                    </div>

                    <div class="list-menu">
                        @foreach ($menus as $item)
                            <div class="d-flex justify-content-between gap-3">
                                <div class="card mt-5 items-center mr-auto" style="width:  20rem;">
                                    <div class="card-header">Tipe</div>
                                    <div class="card-title text-center mt-3 mb-0">{{ $item->nama }}</div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <p class="text-left mb-0">stok :
                                                </p>
                                            <p class="text-right mb-0">Rp.</p>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button class="btn btn-primary w-100">Tambahkan</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="right col-md-4">
                    <div class="card vh-100">
                        <div class="m-3 d-flex justify-content-start align-items-center gap-2">
                            <h3 class="m-0">Pesanan Anda</h3>
                        </div>
                        <hr class="m-0">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
