<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelProdi extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbprodi';
    protected $primaryKey       = 'idprodi';
    protected $useAutoIncrement = false;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_prodi', 'id_jurusan', 'nama_prodi'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getJurusanProdi() {
        return $this->db->table('tbprodi')
        ->join('tbjurusan', 'tbjurusan.id_jurusan=tbprodi.id_jurusan')
        ->orderBy('id_jurusan')
        ->get()->getResultArray();
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
