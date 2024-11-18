<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        // Jika user sudah login, arahkan ke dashboard
        if (session()->get('logged_in')) {
            return redirect()->to(base_url());
        }

        // Tampilkan view login
        return view('admin/login');  // Pastikan path ke view sudah benar
    }

    public function process()
    {
        $users = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $dataUser = $users->where([
            'username' => $username,
        ])->first();

        if ($dataUser) {
            // Periksa apakah status 'aktif' dari enum di database
            if ($dataUser->status === 'Aktif') {
                // Enkripsi password yang dimasukkan dengan MD5
                $encryptedPassword = md5($password);

                // Cek password yang dienkripsi
                if ($encryptedPassword === $dataUser->password) {
                    session()->set([
                        'idUser'    => $dataUser->idUser,
                        'nama'      => $dataUser->nama,      // Sesuaikan dengan kolom nama di database
                        'username'  => $dataUser->username,
                        'level'  => $dataUser->level,
                        'logged_in' => TRUE
                    ]);

                    return redirect()->to(base_url());
                } else {
                    // Set flashdata khusus untuk kesalahan password
                    session()->setFlashdata('errPassword', 'Password yang Anda masukkan salah.');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('error', 'Akun tidak aktif.');
                return redirect()->back();
            }
        } else {
            // Set flashdata khusus untuk kesalahan username
            session()->setFlashdata('errUsername', 'Username tidak ditemukan.');
            return redirect()->back();
        }
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/login'));  // Redirect kembali ke login setelah logout
    }
}
