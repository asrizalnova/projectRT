<?php

namespace App\Controllers;

use App\Models\WargaModel;
use App\Models\KkModel;
use CodeIgniter\Controller;

class WargaController extends Controller
{
    protected $kkModel;
    protected $wargaModel;

    public function __construct()
    {
        $this->kkModel = new KkModel();
        $this->wargaModel = new WargaModel();
    }

    public function index()
    {
        // Fetch the necessary data
        $data['warga_detail'] = $this->wargaModel
            ->select('tbl_warga.*, kk.namaKK') // pilih kolom yang dibutuhkan
            ->join('tbl_kk as kk', 'tbl_warga.noKK = kk.noKK', 'left') // gabungkan dengan tbl_kk berdasarkan noKK
            ->findAll();

        $data['kk'] = $this->kkModel->findAll(); // Fetch all kartu keluarga

        // Menghitung umur berdasarkan tanggal lahir
        foreach ($data['warga_detail'] as &$warga) {
            $warga['umur'] = $this->hitungUmur($warga['tanggalLahir']);
        }

        // Return the view with $data
        return view('admin/warga', $data);
    }

    // Fungsi untuk menghitung umur
    private function hitungUmur($tanggalLahir)
    {
        $tanggalLahir = new \DateTime($tanggalLahir); // Membuat objek DateTime dari tanggal lahir
        $sekarang = new \DateTime(); // Mendapatkan waktu saat ini
        $interval = $tanggalLahir->diff($sekarang); // Menghitung selisih antara tanggal lahir dan waktu saat ini

        return $interval->y; // Mengembalikan umur dalam tahun
    }

    public function store()
    {
        helper(['form', 'url']);

        // Ambil data lainnya dari form
        $noKK = $this->request->getVar('noKK');

        // Pastikan noKK dan idKas diisi, dan idUser tersedia
        if (empty($noKK)) {
            return $this->response->setJSON(['status' => false, 'message' => 'Data tidak lengkap.']);
        }

        // Validasi no KK dan kas apakah sudah terdaftar
        $kkExists = $this->kkModel->where('noKK', $noKK)->first();

        if (!$kkExists) {
            return $this->response->setJSON(['status' => false, 'message' => 'No KK tidak ditemukan.']);
        }

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nik' => 'required',
            'noKK' => 'required',
            'nama' => 'required',
            'jenisKelamin' => 'required',
            'tempatLahir' => 'required',
            'tanggalLahir' => 'required|valid_date',
            'status' => 'required',
            'pekerjaan' => 'required',
            'statusAktif' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['status' => false, 'errors' => $validation->getErrors()]);
        }

        // Data valid, simpan ke database
        $data = [
            'nik' => $this->request->getVar('nik'),
            'noKK' => $noKK,
            'nama' => $this->request->getVar('nama'),
            'jenisKelamin' => $this->request->getVar('jenisKelamin'),
            'tempatLahir' => $this->request->getVar('tempatLahir'),
            'tanggalLahir' => $this->request->getVar('tanggalLahir'),
            'status' => $this->request->getVar('status'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'keterangan' => $this->request->getVar('keterangan'),
            'statusAktif' => $this->request->getVar('statusAktif'),
        ];

        $save = $this->wargaModel->insert($data);

        if ($save) {
            return $this->response->setJSON(['status' => true, 'message' => 'Data berhasil ditambahkan.']);
        } else {
            return $this->response->setJSON(['status' => false, 'message' => 'Gagal menambahkan data.']);
        }
    }


    public function edit($nik)
    {
        // Ambil data iuran berdasarkan ID
        $data['warga'] = $this->wargaModel->find($nik);
        if (!$data['warga']) {
            return $this->response->setJSON(['status' => false, 'message' => 'Data tidak ditemukan.']);
        }

        // Ambil data untuk dropdown
        $data['kk'] = $this->kkModel->findAll();     // Ambil semua kartu keluarga

        return $this->response->setJSON($data); // Mengirim data sebagai JSON untuk ditampilkan di modal
    }


    public function update($id)
    {
        helper(['form', 'url']);
        $model = $this->wargaModel;

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nik' => 'required',
            'noKK' => 'required',
            'nama' => 'required',
            'jenisKelamin' => 'required',
            'tempatLahir' => 'required',
            'tanggalLahir' => 'required|valid_date',
            'status' => 'required',
            'pekerjaan' => 'required',
            'statusAktif' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['status' => false, 'errors' => $validation->getErrors()]);
        }

        // Update data di database
        $data = [
            'nik' => $this->request->getVar('nik'),
            'noKK' => $this->request->getVar('noKK'),
            'nama' => $this->request->getVar('nama'),
            'jenisKelamin' => $this->request->getVar('jenisKelamin'),
            'tempatLahir' => $this->request->getVar('tempatLahir'),
            'tanggalLahir' => $this->request->getVar('tanggalLahir'),
            'status' => $this->request->getVar('status'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'keterangan' => $this->request->getVar('keterangan'),
            'statusAktif' => $this->request->getVar('statusAktif'),
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
        $model = $this->wargaModel;

        if ($model->find($id)) {
            $model->delete($id);
            return $this->response->setJSON(['status' => true, 'redirect' => site_url('warga')]);
        } else {
            return $this->response->setJSON(['status' => false, 'redirect' => site_url('warga')]);
        }
    }
}
