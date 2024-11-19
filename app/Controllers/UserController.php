<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();

    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        } elseif (session()->get('level') !== 'Super Admin') {
            return redirect()->to(base_url('/')); // Redirect ke halaman login jika bukan superadmin
        }

        $model = $this->userModel;
        $data['user_detail'] = $model->orderBy('idUser')->findAll();

        return view('admin/user', $data);
    }

    public function store()
    {
        helper(['form', 'url']);
        $model = $this->userModel;

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'username' => 'required|is_unique[tbl_user.username]',
            'level' => 'required',
            'status' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal
            return $this->response->setJSON(['status' => false, 'errors' => $validation->getErrors()]);
        }

        // Data valid, simpan ke database
        $data = [
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'level' => $this->request->getVar('level'),
            'status' => $this->request->getVar('status')
        ];

        $save = $model->insert($data);

        if ($save) {
            // Mengembalikan respons sukses
            return $this->response->setJSON(['status' => true, 'message' => 'Data berhasil ditambahkan.']);
        } else {
            // Gagal menyimpan, mengembalikan respons error
            return $this->response->setJSON(['status' => false, 'message' => 'Gagal menambahkan data.']);
        }
    }

    public function edit($idUser)
    {
        // Ambil data iuran berdasarkan ID
        $data['user'] = $this->userModel->find($idUser);
        if (!$data['user']) {
            return $this->response->setJSON(['status' => false, 'message' => 'Data tidak ditemukan.']);
        }

        return $this->response->setJSON($data); // Mengirim data sebagai JSON untuk ditampilkan di modal
    }

    public function update($id)
    {
        helper(['form', 'url']);
        $model = new UserModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'username' => 'required',
            'level' => 'required',
            'status' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['status' => false, 'errors' => $validation->getErrors()]);
        }

        // Update data di database
        $data = [
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'level' => $this->request->getVar('level'),
            'status' => $this->request->getVar('status')
        ];

        $update = $model->update($id, $data);

        if ($update === false) {
            return $this->response->setJSON(['status' => false, 'message' => 'Gagal memperbarui data.']);
        } else {
            return $this->response->setJSON(['status' => true, 'message' => 'Data berhasil diperbarui.']);
        }
    }

    public function delete($id)
    {
        $userModel = new UserModel(); // Sesuaikan nama model Anda
        $user = $userModel->find($id);

        if (!$user) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Data User tidak ditemukan.'
            ]);
        }

        if ($userModel->delete($id)) {
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Data User berhasil dihapus.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Gagal menghapus data User.'
            ]);
        }
    }

    public function changePassword($id)
    {
        // Mengambil password baru dan konfirmasi password dari POST
        $newPassword = $this->request->getPost('newPassword');
        $confirmPassword = $this->request->getPost('confirmPassword');

        // Validasi password baru dan konfirmasi
        if ($newPassword !== $confirmPassword) {
            return $this->response->setJSON(['success' => false, 'message' => 'Password baru dan konfirmasi password tidak cocok.']);
        }

        // Enkripsi password baru menggunakan MD5
        $hashedPassword = md5($newPassword);

        // Model untuk mengakses data user
        $userModel = new UserModel();

        // Mencari user berdasarkan ID
        $user = $userModel->find($id);

        if ($user) {
            // Memperbarui password
            $userModel->update($id, ['password' => $hashedPassword]);

            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Pengguna tidak ditemukan.']);
        }
    }
}
