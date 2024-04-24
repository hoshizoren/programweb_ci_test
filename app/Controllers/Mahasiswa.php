<?php

namespace App\Controllers;

use App\Models\ModelMahasiswa;
use App\Models\M_jurusan;
use App\Models\M_prodi;

class Mahasiswa extends BaseController
{
    protected $mhsModel;

    public function __construct()
    {
        $this->mhsModel = new ModelMahasiswa();
        $modelJurusan = new M_jurusan();
        $modelProdi = new M_prodi();

        $this->data['jurusan'] = $modelJurusan->getJurusan();
        $this->data['prodi'] = $modelProdi->getAllProdiOptions();
        $this->data['mahasiswa'] = $this->mhsModel->getMahasiswaWithJurusanProdi();
    }

    public function index()
    {
        $session = session();
        if ($session->get('username') != NULL) {
            return view('layouts/master/mahasiswa/view-mahasiswa', $this->data);
        } else {
            return redirect()->to(base_url('./'));
        }
    }

    public function simpan()
    {
        try {
            $nim = $this->request->getPost('nim');
            $ada = $this->mhsModel->where('nim', $nim)->first();

            if ($ada) {
                // Mahasiswa dengan NIM yang sama sudah ada di database
                session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Gagal,
                Nim Mahasiswa sudah ada di database.</h5>
                </div>');
                return redirect()->to('/mahasiswa');
            } else {
                // Mahasiswa tidak ada, lanjutkan untuk menyimpan data
                $data = [
                    'nim' => $nim,
                    'nama' => $this->request->getPost('nama'),
                    'alamat' => $this->request->getPost('alamat'),
                    'jenkel' => $this->request->getPost('jk'),
                    'id_jurusan' => $this->request->getPost('jurusan'),
                    'kode_prodi' => $this->request->getPost('prodi')
                ];

                $this->mhsModel->insert($data);

                // Set flash message for success
                session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Sukses
                Simpan Data Mahasiswa.</h5>
                </div>');
                return redirect()->to('/mahasiswa');
            }
        } catch (\Exception $e) {
            log_message('error', 'Error inserting data: ' . $e->getMessage());

            // Set flash message for error
            session()->setFlashdata('pesan', 'Error inserting data: ' . $e->getMessage());
            return redirect()->to('/mahasiswa');
        }
    }



    public function edit($nim)
    {
        $mahasiswa = $this->mhsModel->find($nim);

        if (!$mahasiswa) {
            return redirect()->to('/mahasiswa')->with('error', 'Mahasiswa tidak ditemukan');
        }

        // Pass student data and existing jurusan/prodi data to the view
        return view('edit_mahasiswa', [
            'mahasiswa' => $mahasiswa,
            'jurusan' => $this->data['jurusan'],
            'prodi' => $this->data['prodi'],
        ]);
    }


    public function update()
    {
        try {
            $nim = $this->request->getPost('nim');
            $data = [
                'nama' => $this->request->getPost('nama'),
                'alamat' => $this->request->getPost('alamat'),
                'jenkel' => $this->request->getPost('jk'),
                'id_jurusan' => $this->request->getPost('jurusan'),
                'kode_prodi' => $this->request->getPost('prodi')
            ];

            $this->mhsModel->update($nim, $data);

            return redirect()->to('/mahasiswa');
        } catch (\Exception $e) {
            log_message('error', 'Error updating data: ' . $e->getMessage());
            echo 'Error updating data: ' . $e->getMessage();
        }
    }

    public function getMahasiswaWithJurusanProdi()
    {
        return $this->db->table($this->table)
            ->select('tbmahasiswa.nim, tbmahasiswa.nama, tbmahasiswa.alamat, tbmahasiswa.jenkel, tbmahasiswa.kode_prodi, tbjurusan.nama_jurusan, tbprodi.nama_prodi')
            ->join('tbjurusan', 'tbmahasiswa.id_jurusan = tbjurusan.id_jurusan')
            ->join('tbprodi', 'tbmahasiswa.kode_prodi = tbprodi.kode_prodi')
            ->get()
            ->getResult();
    }
}
