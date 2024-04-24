<?php

namespace App\Controllers;

use App\Models\ModelUser;

class Home extends BaseController
{
    public function index(): string
    {
        // return view('layouts/v_konten');
        return view('layouts/login');
    }

    public function menu(): string
    {
        $session = session();
        if($session->get('username') != NULL) {
            return view('layouts/v_konten');
        } else {
            return redirect()->to(base_url('./'));
        }
    }


    public function inputmahasiswa(): string
    {
        return view('layouts/master/v_mahasiswa');
    }

    public function inputmatakuliah(): string
    {
        return view('layouts/master/v_matakuliah');
    }

    public function ceklogin()
    {
        $user = new ModelUser();
        $session = session();
        $usr = $this->request->getVar('username');
        $psw = $this->request->getVar('password');
        $ada = $user->where("username = '$usr' AND password='$psw'")->first();
        if ($ada) {
            $session->set('username', $ada['username']);
            $session->set('nama', $ada['nama']);
            $session->set('level', $ada['level']);
            return redirect()->to(base_url('./menu'));
        } else {
            $session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i>Oppss Username atau Password salah.</h5>
            </div>');
            return redirect()->to(base_url('./'));
        }
    }

    public function logout() {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('./'));
    }
}
