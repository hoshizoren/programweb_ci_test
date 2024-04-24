<form id="formEditMahasiswa" action="<?= base_url('mahasiswa/update') ?>" method="post">
    <div class="modal fade" id="edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Mahasiswa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="nim" id="nim" value="<?= isset($mahasiswa['nim']) ? $mahasiswa['nim'] : '' ?>">
                    <div class="form-group">
                        <label for="exampleInputName">Nama</label>
                        <input type="hidden" name="id_mahasiswa" value="<?= isset($mahasiswa['id_mahasiswa']) ? $mahasiswa['id_mahasiswa'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputAddress">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat" value="<?= isset($mahasiswa['alamat']) ? $mahasiswa['alamat'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputGender">Jenis Kelamin</label>
                        <select class="form-control" name="jk">
                            <option value="Pria" <?= (isset($mahasiswa['jenkel']) && $mahasiswa['jenkel'] == 'Pria') ? 'selected' : '' ?>>Pria</option>
                            <option value="Wanita" <?= (isset($mahasiswa['jenkel']) && $mahasiswa['jenkel'] == 'Wanita') ? 'selected' : '' ?>>Wanita</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputJurusan">Jurusan</label>
                        <select class="form-control" id="jurusan" name="jurusan" required>
                            <option value="">Pilih Jurusan</option>
                            <?php foreach ($jurusan as $row) : ?>
                                <option value="<?= $row['id_jurusan'] ?>" <?= (isset($mahasiswa['id_jurusan']) && $row['id_jurusan'] == $mahasiswa['id_jurusan']) ? 'selected' : '' ?>>
                                    <?= $row['nama_jurusan'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputProdi">Prodi</label>
                        <select class="form-control" id="prodi" name="prodi" required>
                            <option value="">Pilih Prodi</option>
                            <?php foreach ($prodi as $row) : ?>
                                <option value="<?= $row['kode_prodi'] ?>" <?= (isset($mahasiswa['kode_prodi']) && $row['kode_prodi'] == $mahasiswa['kode_prodi']) ? 'selected' : '' ?>>
                                    <?= $row['nama_prodi'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-save"></i> Update</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>

<script>
        // Fungsi untuk memuat data ke dalam form edit saat modal ditampilkan
        $('#edit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var nim = button.data('nim'); // Ekstrak data dari atribut data
            var nama = button.data('nama');
            var alamat = button.data('alamat');
            var jenkel = button.data('jenkel');
            var idJurusan = button.data('id-jurusan');
            var kodeProdi = button.data('kode-prodi');

            // Memasukkan data ke dalam form edit
            var modal = $(this);
            modal.find('.modal-body #nim').val(nim);
            modal.find('.modal-body #nama').val(nama);
            modal.find('.modal-body #alamat').val(alamat);
            modal.find('.modal-body select[name="jk"]').val(jenkel);
            modal.find('.modal-body select[name="jurusan"]').val(idJurusan);

            // Setelah jurusan dipilih, panggil fungsi updateProdiOptions untuk memuat opsi prodi sesuai dengan jurusan yang dipilih
            updateProdiOptions();

            // Setelah opsi prodi dimuat, pilih prodi yang sesuai dengan data yang diterima dari tombol
            modal.find('.modal-body select[name="prodi"]').val(kodeProdi);
        });
    </script>

    <script>
        // Function to handle the edit button click event
        function editMahasiswa(nim) {
            // AJAX request to fetch Mahasiswa data by nim
            $.ajax({
                url: '<?= base_url('mahasiswa/get_mahasiswa_by_nim') ?>',
                method: 'POST',
                data: {
                    nim: nim
                },
                dataType: 'json',
                success: function(response) {
                    // Populate input fields in the edit modal with retrieved data
                    $('#nim').val(response.nim);
                    $('#nama').val(response.nama);
                    $('#alamat').val(response.alamat);
                    $('#jk').val(response.jenkel);
                    $('#jurusan').val(response.id_jurusan);

                    // Trigger change event for Jurusan select to update Prodi options
                    $('#jurusan').trigger('change');

                    // Show the edit modal
                    $('#edit').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>