<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Loginctrl extends BaseController
{
    public function index()
    {
        // If user is already logged in, redirect to dashboard
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('admin/dashboard'));
        }

        // Show login view
        return view('admin/Login/index');  // Correct the path to your view
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
            if ($password === $dataUser->password) {
                session()->set([
                    'username' => $dataUser->username,
                    'logged_in' => TRUE
                ]);
                return redirect()->to(base_url('admin/dashboard'));
            } else {
                session()->setFlashdata('error', 'Username & Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->back();
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));  // Redirect back to login after logout
    }
}
