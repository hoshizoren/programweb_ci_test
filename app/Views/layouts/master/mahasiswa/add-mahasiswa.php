<?= $this->extend('layouts/template') ?>
<?= $this->extend('layouts/master/mahasiswa/view-mahasiswa') ?>

<?= $this->section('tambah') ?>

<form id="formTambahMahasiswa" action="<?= base_url('mahasiswa/simpan') ?>" method="post">
    <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input Data Mahasiswa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputNIM">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" placeholder="Enter NIM">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama ">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputAddress">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputGender">Jenis Kelamin</label>
                        <select class="form-control" name="jk">
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputJurusan">Jurusan</label>
                        <select class="form-control" id="jurusan" name="jurusan" required>
                            <option value="">Pilih Jurusan</option>
                            <?php foreach ($jurusan as $row) : ?>
                                <option value="<?= $row['id_jurusan'] ?>"><?= $row['nama_jurusan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputProdi">Prodi</label>
                        <select class="form-control" id="prodi" name="prodi" required>
                            <option value="">Pilih Prodi</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>

<script>
        // Siapkan variabel prodiOptions
        const prodiOptions = <?= json_encode($prodi) ?>; // Menggunakan data Prodi yang dikirim dari controller

        // Function to populate Prodi options based on selected Jurusan
        function updateProdiOptions() {
            // Mendapatkan referensi dari select Jurusan dan Prodi
            const jurusanSelect = document.getElementById('jurusan');
            const prodiSelect = document.getElementById('prodi');
            // Mendapatkan nilai Jurusan yang dipilih
            const selectedJurusan = jurusanSelect.value;

            // Membersihkan opsi Prodi yang ada sebelumnya
            prodiSelect.innerHTML = '';

            // Menambahkan opsi default
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Pilih Prodi';
            prodiSelect.appendChild(defaultOption);

            // Menambahkan opsi Prodi berdasarkan Jurusan yang dipilih
            if (selectedJurusan && prodiOptions[selectedJurusan]) {
                prodiOptions[selectedJurusan].forEach(prodi => {
                    const option = document.createElement('option');
                    option.value = prodi.kode_prodi;
                    option.textContent = prodi.nama_prodi;
                    prodiSelect.appendChild(option);
                });
            }
        }

        // Memanggil fungsi untuk pertama kali saat halaman dimuat
        updateProdiOptions();

        // Mengaitkan event listener untuk memperbarui opsi Prodi saat Jurusan dipilih
        document.getElementById('jurusan').addEventListener('change', updateProdiOptions);
    </script>

<?= $this->endSection() ?>