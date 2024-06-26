<div class="modal fade" id="absensiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post">
                <div class="modal-body">
                    @csrf
                    <div id="method">

                    </div>
                    <div class="form-group row">
                        <label for="nama_karyawan" class="col-sm-4 col-form-label">Nama Karyawan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama_karyawan" value=""
                                name="nama_karyawan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_masuk" class="col-sm-4 col-form-label">Tanggal Masuk</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tanggal_masuk" value=""
                                name="tanggal_masuk">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="waktu_masuk" class="col-sm-4 col-form-label">Waktu Masuk</label>
                        <div class="col-sm-8">
                            <input type="time" step="1" class="form-control" id="waktu_masuk" value=""
                                name="waktu_masuk">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="status">
                                <option value="masuk">masuk</option>
                                <option value="sakit">Sakit</option>
                                <option value="izin">Izin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="waktu_selesai" class="col-sm-4 col-form-label">Waktu Selesai</label>
                        <div class="col-sm-8">
                            <input type="time" class="form-control" id="waktu_selesai" value=""
                                name="waktu_selesai">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
