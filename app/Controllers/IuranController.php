<?php

namespace App\Controllers;

use App\Models\IuranModel;
use App\Models\KkModel;
use App\Models\UserModel;
use App\Models\KasModel;
use CodeIgniter\Controller;

class IuranController extends Controller
{
    protected $iuranModel;
    protected $kasModel;
    protected $kkModel;
    protected $userModel;

    public function __construct()
    {
        $this->iuranModel = new IuranModel();
        $this->kasModel = new KasModel();
        $this->kkModel = new KkModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Fetch the necessary data
        $data['iuran_detail'] = $this->iuranModel
            ->select('tbl_iuran.*, kas.namaKas, kk.namaKK, user.nama') // pilih kolom yang dibutuhkan
            ->join('tbl_kas as kas', 'tbl_iuran.idKas = kas.idKas', 'left') // gabungkan dengan tbl_kas berdasarkan idKas
            ->join('tbl_kk as kk', 'tbl_iuran.noKK = kk.noKK', 'left') // gabungkan dengan tbl_kk berdasarkan noKK
            ->join('tbl_user as user', 'tbl_iuran.idUser = user.idUser', 'left') // gabungkan dengan tbl_user berdasarkan idUser
            ->findAll();

        $data['users'] = $this->userModel->findAll(); // Fetch all users
        $data['kas'] = $this->kasModel->findAll(); // Fetch all kas
        $data['kk'] = $this->kkModel->findAll(); // Fetch all kartu keluarga

        // Return the view with $data
        return view('admin/iuran', $data);
    }

    public function store()
    {
        helper(['form', 'url']);

        // Ambil idUser dari session
        $session = session();
        $idUser = $session->get('idUser');

        // Ambil data lainnya dari form
        $noKK = $this->request->getVar('noKK');
        $idKas = $this->request->getVar('idKas');

        // Pastikan noKK dan idKas diisi, dan idUser tersedia
        if (empty($noKK) || empty($idKas) || empty($idUser)) {
            return $this->response->setJSON(['status' => false, 'message' => 'Data tidak lengkap.']);
        }

        // Validasi no KK dan kas apakah sudah terdaftar
        $kkExists = $this->kkModel->where('noKK', $noKK)->first();
        $kasExists = $this->kasModel->find($idKas);

        if (!$kkExists || !$kasExists) {
            return $this->response->setJSON(['status' => false, 'message' => 'No KK atau ID Kas tidak ditemukan.']);
        }

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'idKas' => 'required',
            'noKK' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|valid_date'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['status' => false, 'errors' => $validation->getErrors()]);
        }

        // Data valid, simpan ke database
        $data = [
            'idUser' => $idUser, // Ambil idUser dari session
            'idKas' => $idKas,
            'noKK' => $noKK,
            'bulan' => $this->request->getVar('bulan'),
            'tahun' => $this->request->getVar('tahun'),
            'jumlah' => $this->request->getVar('jumlah'),
            'tanggal' => $this->request->getVar('tanggal'),
        ];

        $save = $this->iuranModel->insert($data);

        if ($save) {
            return $this->response->setJSON(['status' => true, 'message' => 'Data berhasil ditambahkan.']);
        } else {
            return $this->response->setJSON(['status' => false, 'message' => 'Gagal menambahkan data.']);
        }
    }


    public function edit($id)
    {
        // Ambil data iuran berdasarkan ID
        $data['iuran'] = $this->iuranModel->find($id);
        if (!$data['iuran']) {
            return $this->response->setJSON(['status' => false, 'message' => 'Data tidak ditemukan.']);
        }

        // Ambil data untuk dropdown
        $data['users'] = $this->userModel->findAll(); // Ambil semua user
        $data['kas'] = $this->kasModel->findAll();   // Ambil semua kas
        $data['kk'] = $this->kkModel->findAll();     // Ambil semua kartu keluarga

        return $this->response->setJSON($data); // Mengirim data sebagai JSON untuk ditampilkan di modal
    }


    public function update($id)
    {
        helper(['form', 'url']);
        $model = $this->iuranModel;

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'idKas' => 'required',
            'noKK' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|valid_date'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['status' => false, 'errors' => $validation->getErrors()]);
        }

        // Update data di database
        $data = [
            'idKas' => $this->request->getVar('idKas'),
            'noKK' => $this->request->getVar('noKK'),
            'bulan' => $this->request->getVar('bulan'),
            'tahun' => $this->request->getVar('tahun'),
            'jumlah' => $this->request->getVar('jumlah'),
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
        $model = $this->iuranModel;

        if ($model->find($id)) {
            $model->delete($id);
            return $this->response->setJSON(['status' => true, 'redirect' => site_url('iuran')]);
        } else {
            return $this->response->setJSON(['status' => false, 'redirect' => site_url('iuran')]);
        }
    }




    // Tambahkan metode edit, update, dan delete di sini jika diperlukan
}
