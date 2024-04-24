<?php

namespace App\Models;

use CodeIgniter\Model;

class M_jurusan extends Model
{
    protected $table = 'tbjurusan';

    public function getJurusan()
    {
        return $this->findAll();
    }
}
