{{-- <div class="modal fade" id="absensiEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" action="{{ route('absensis.update', $absensi->id) }}">
                <!-- Ubah route sesuai dengan route yang kamu miliki -->
                @csrf
                @method('PUT') <!-- Gunakan method PUT untuk update data -->
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama_karyawan" class="col-sm-4 col-form-label">Nama Karyawan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama_karyawan"
                                value="{{ $absensi->nama_karyawan }}" name="nama_karyawan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_masuk" class="col-sm-4 col-form-label">Tanggal Masuk</label>
                        <div class="col-sm-8">
                            <input type="date" step="1" class="form-control" id="tanggal_masuk"
                                value="{{ $absensi->tanggal_masuk }}" name="tanggal_masuk">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="waktu_masuk" class="col-sm-4 col-form-label">Waktu Masuk</label>
                        <div class="col-sm-8">
                            <input type="time" step="1" class="form-control" id="waktu_masuk"
                                value="{{ $absensi->waktu_masuk }}" name="waktu_masuk">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="status">
                                <option value="masuk" {{ $absensi->status == 'masuk' ? 'selected' : '' }}>Masuk
                                </option>
                                <option value="sakit" {{ $absensi->status == 'sakit' ? 'selected' : '' }}>Sakit
                                </option>
                                <option value="izin" {{ $absensi->status == 'izin' ? 'selected' : '' }}>Izin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="waktu_keluar" class="col-sm-4 col-form-label">Waktu Keluar</label>
                        <div class="col-sm-8">
                            <input type="time" step="1" class="form-control" id="waktu_keluar"
                                value="{{ $absensi->waktu_keluar }}" name="waktu_keluar">
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
</div> --}}
