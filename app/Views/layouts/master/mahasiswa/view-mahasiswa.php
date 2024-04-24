<?php

$session = session(); 

?>
<?= $this->extend('layouts/template') ?>

<?= $this->section('konten') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Mahasiswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active">Mahasiswa</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                                    <i class="fa fa-plus">Tambah</i>
                                </button>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <?php if ((session()->getFlashdata('pesan') !== NULL)) {
                                echo session()->getFlashdata('pesan');
                            } ?>
                            <table class="table table-hover text-wrap">
                                <thead>
                                    <tr>
                                        <th width="5%">NO</th>
                                        <th width="10%">NIM</th>
                                        <th>NAMA</th>
                                        <th>ALAMAT</th>
                                        <th>JENIS KELAMIN</th>
                                        <th>JURUSAN</th>
                                        <th>PRODI</th>
                                        <th width="10%">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $nom = 1;
                                    foreach ($mahasiswa as $mhs) : ?>
                                        <tr>
                                            <td><?= $nom++ ?></td>
                                            <td><?= $mhs->nim ?></td>
                                            <td><?= $mhs->nama ?></td>
                                            <td><?= $mhs->alamat ?></td>
                                            <td><?= $mhs->jenkel ?></td>
                                            <td><?= $mhs->nama_jurusan ?></td>
                                            <td><?= $mhs->nama_prodi ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning" onclick="editMahasiswa('<?= $mhs->nim ?>')">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Footer
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
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