<?php

namespace App\Models;

use CodeIgniter\Model;

class M_prodi extends Model
{
    protected $table = 'tbprodi';

    public function getProdi()
    {
        return $this->findAll();
    }

    public function getAllProdiOptions()
    {
        // Ambil semua data Prodi dari database
        $prodi = $this->findAll();

        // Siapkan array untuk menyimpan data Prodi dalam format yang sesuai untuk JavaScript
        $prodiOptions = [];

        // Lakukan pengolahan data
        foreach ($prodi as $row) {
            $prodiOptions[$row['id_jurusan']][] = [
                'kode_prodi' => $row['kode_prodi'],
                'nama_prodi' => $row['nama_prodi']
            ];
        }

        return $prodiOptions;
    }
}
