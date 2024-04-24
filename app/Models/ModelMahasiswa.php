<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMahasiswa extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbmahasiswa';
    protected $primaryKey       = 'nim';
    protected $useAutoIncrement = false;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nim', 'nama', 'alamat', 'jenkel', 'id_jurusan', 'kode_prodi'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getMahasiswaWithJurusanProdi()
    {
        return $this->db->table($this->table)
            ->select('tbmahasiswa.nim, tbmahasiswa.nama, tbmahasiswa.alamat, tbmahasiswa.jenkel, tbjurusan.nama_jurusan, tbprodi.nama_prodi')
            ->join('tbjurusan', 'tbmahasiswa.id_jurusan = tbjurusan.id_jurusan')
            ->join('tbprodi', 'tbmahasiswa.kode_prodi = tbprodi.kode_prodi')
            ->get()
            ->getResult();
    }

    public function updateMahasiswa($data, $nim)
    {
        return $this->update($nim, $data);
    }

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
