<?php

namespace App\Controllers;

use App\Models\PengeluaranModel;
use App\Models\UserModel;
use App\Models\KasModel;
use CodeIgniter\Controller;

class PengeluaranController extends Controller
{
    protected $pengeluaranModel;
    protected $kasModel;
    protected $userModel;

    public function __construct()
    {
        $this->pengeluaranModel = new PengeluaranModel();
        $this->kasModel = new KasModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Fetch the necessary data
        $data['pengeluaran_detail'] = $this->pengeluaranModel
            ->select('tbl_pengeluaran.*, kas.namaKas, user.nama') // pilih kolom yang dibutuhkan
            ->join('tbl_kas as kas', 'tbl_pengeluaran.idKas = kas.idKas', 'left') // gabungkan dengan tbl_kas berdasarkan idKas
            ->join('tbl_user as user', 'tbl_pengeluaran.idUser = user.idUser', 'left') // gabungkan dengan tbl_user berdasarkan idUser
            ->findAll();

        $data['users'] = $this->userModel->findAll(); // Fetch all users
        $data['kas'] = $this->kasModel->findAll(); // Fetch all kas

        // Return the view with $data
        return view('admin/pengeluaran', $data);
    }

    public function store()
    {
        helper(['form', 'url']);

        // Ambil idUser dari session
        $session = session();
        $idUser = $session->get('idUser');

        // Ambil data lainnya dari form
        $idKas = $this->request->getVar('idKas');

        // Pastikan noKK dan idKas diisi, dan idUser tersedia
        if (empty($idKas) || empty($idUser)) {
            return $this->response->setJSON(['status' => false, 'message' => 'Data tidak lengkap.']);
        }

        // Validasi kas apakah sudah terdaftar
        $kasExists = $this->kasModel->find($idKas);

        if (!$kasExists) {
            return $this->response->setJSON(['status' => false, 'message' => 'ID Kas tidak ditemukan.']);
        }

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'idKas' => 'required',
            'namaPengeluaran' => 'required',
            'int' => 'required|numeric',
            'tanggal' => 'required|valid_date'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['status' => false, 'errors' => $validation->getErrors()]);
        }

        // Data valid, simpan ke database
        $data = [
            'idUser' => $idUser, // Ambil idUser dari session
            'idKas' => $idKas,
            'namaPengeluaran' => $this->request->getVar('namaPengeluaran'),
            'int' => $this->request->getVar('int'),
            'tanggal' => $this->request->getVar('tanggal'),
        ];

        $save = $this->pengeluaranModel->insert($data);

        if ($save) {
            return $this->response->setJSON(['status' => true, 'message' => 'Data berhasil ditambahkan.']);
        } else {
            return $this->response->setJSON(['status' => false, 'message' => 'Gagal menambahkan data.']);
        }
    }


    public function edit($id)
    {
        // Ambil data iuran berdasarkan ID
        $data['pengeluaran'] = $this->pengeluaranModel->find($id);
        if (!$data['pengeluaran']) {
            return $this->response->setJSON(['status' => false, 'message' => 'Data tidak ditemukan.']);
        }

        // Ambil data untuk dropdown
        $data['users'] = $this->userModel->findAll(); // Ambil semua user
        $data['kas'] = $this->kasModel->findAll();   // Ambil semua kas

        return $this->response->setJSON($data); // Mengirim data sebagai JSON untuk ditampilkan di modal
    }


    public function update($id)
    {
        helper(['form', 'url']);
        $model = $this->pengeluaranModel;

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'idKas' => 'required',
            'namaPengeluaran' => 'required',
            'int' => 'required|numeric',
            'tanggal' => 'required|valid_date'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['status' => false, 'errors' => $validation->getErrors()]);
        }

        // Update data di database
        $data = [
            'idKas' => $this->request->getVar('idKas'),
            'namaPengeluaran' => $this->request->getVar('namaPengeluaran'),
            'int' => $this->request->getVar('int'),
            'tanggal' => $this->request->getVar('tanggal'),
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
        $model = $this->pengeluaranModel;

        if ($model->find($id)) {
            $model->delete($id);
            return $this->response->setJSON(['status' => true, 'redirect' => site_url('pengeluaran')]);
        } else {
            return $this->response->setJSON(['status' => false, 'redirect' => site_url('pengeluaran')]);
        }
    }
}
