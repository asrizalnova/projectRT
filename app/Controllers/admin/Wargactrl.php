<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\WargaModel;
use App\Models\KkModel;

class Wargactrl extends BaseController
{
    protected $wargaModel;
    protected $kkModel;

    public function __construct()
    {
        $this->wargaModel = new WargaModel();
        $this->kkModel = new KkModel();
    }
    public function index()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }

        $warga_model = new WargaModel();
        $all_data_warga = $warga_model->findAll();
        $validation = \Config\Services::validation();
        
        return view('admin/warga/index', [
            'all_data_warga' => $all_data_warga,
            'validation' => $validation
        ]);
    }

    public function tambah()
    {
        // Mengambil data semua KK untuk dropdown
        $data['all_kk'] = $this->kkModel->findAll();
        
        return view('admin/warga/tambah', $data);
    }

    public function proses_tambah()
    {
        // Ambil no KK dari input
        $noKk = $this->request->getVar('noKk');
    
        // Validasi KK
        $kkExists = $this->kkModel->where('noKK', $noKk)->first();
        if (!$kkExists) {
            session()->setFlashdata('error', 'No KK tidak ditemukan.');
            return redirect()->back()->withInput();
        }
    
        // Validasi input
        if (!$this->validate([
            'nik' => 'required|is_unique[tbl_warga.nik]',
            'noKk' => 'required|exact_length[16]',
            'nama' => 'required|max_length[45]',
            'jenisKelamin' => 'required|in_list[Laki-Laki,Perempuan]',
            'tempatLahir' => 'required|max_length[36]',
            'tanggalLahir' => 'required|valid_date[Y-m-d]',
            'status' => 'required|in_list[Kepala Keluarga,Istri,Anak]',
            'pekerjaan' => 'required|max_length[72]',
            'keterangan' => 'max_length[255]',
            'statusAktif' => 'required|in_list[Aktif,Pindah,Meninggal]',
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
    
        // Simpan data
        $data = [
            'nik' => $this->request->getVar('nik'),
            'noKk' => $noKk,
            'nama' => $this->request->getVar('nama'),
            'jenisKelamin' => $this->request->getVar('jenisKelamin'),
            'tempatLahir' => $this->request->getVar('tempatLahir'),
            'tanggalLahir' => $this->request->getVar('tanggalLahir'),
            'status' => $this->request->getVar('status'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'keterangan' => $this->request->getVar('keterangan'),
            'statusAktif' => $this->request->getVar('statusAktif'),
        ];
    
        // Cek hasil penyimpanan
        if ($this->wargaModel->save($data) === false) {
            // Jika gagal, ambil kesalahan dan tampilkan pesan
            session()->setFlashdata('error', 'Gagal menambahkan data: ' . implode(', ', $this->wargaModel->errors()));
            return redirect()->back()->withInput();
        }
    
        // Pesan sukses jika tidak ada masalah
        session()->setFlashdata('success', 'Data Warga berhasil ditambahkan.');
        return redirect()->to(base_url('/warga'));
    }
    
    public function edit($nik)
{
    // Pengecekan apakah pengguna sudah login atau belum
    if (!session()->get('logged_in')) {
        return redirect()->to(base_url('login')); 
    }

    // Temukan data warga berdasarkan NIK
    $wargaData = $this->wargaModel->find($nik);

    // Jika data tidak ditemukan, kembalikan dengan pesan kesalahan
    if (!$wargaData) {
        session()->setFlashdata('error', 'Data tidak ditemukan.');
        return redirect()->to(base_url('admin/warga/index'));
    }

    // Ambil semua nomor KK dan nama KK dari tabel tbl_kk
    $kkData = $this->kkModel->select('noKK, namaKK')->findAll();

    return view('admin/warga/edit', [
        'wargaData' => $wargaData,
        'kkData' => $kkData // Kirim data KK ke view
    ]);
}


public function proses_edit($nik)
{
    // Pengecekan apakah pengguna sudah login atau belum
    if (!session()->get('logged_in')) {
        return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
    }

    // Ambil no KK dari input
    $noKk = $this->request->getVar('noKk');
    log_message('debug', 'No KK untuk edit: ' . $noKk);

    // Validasi KK
    $kkExists = $this->kkModel->where('noKK', $noKk)->first();
    if (!$kkExists) {
        session()->setFlashdata('error', 'No KK tidak ditemukan.');
        return redirect()->back()->withInput();
    }

    // Validasi input
    if (!$this->validate([
        'nik' => 'required',
        'noKk' => 'required|exact_length[16]',
        'nama' => 'required|max_length[45]',
        'jenisKelamin' => 'required|in_list[Laki-Laki,Perempuan]',
        'tempatLahir' => 'required|max_length[36]',
        'tanggalLahir' => 'required|valid_date[Y-m-d]',
        'status' => 'required|in_list[Kepala Keluarga,Istri,Anak]',
        'pekerjaan' => 'required|max_length[72]',
        'keterangan' => 'max_length[255]',
        'statusAktif' => 'required|in_list[Aktif,Pindah,Meninggal]',
    ])) {
        session()->setFlashdata('error', $this->validator->listErrors());
        return redirect()->back()->withInput();
    }

    // Simpan data
    $data = [
        'nik' => $this->request->getVar('nik'),
        'noKk' => $noKk,
        'nama' => $this->request->getVar('nama'),
        'jenisKelamin' => $this->request->getVar('jenisKelamin'),
        'tempatLahir' => $this->request->getVar('tempatLahir'),
        'tanggalLahir' => $this->request->getVar('tanggalLahir'),
        'status' => $this->request->getVar('status'),
        'pekerjaan' => $this->request->getVar('pekerjaan'),
        'keterangan' => $this->request->getVar('keterangan'),
        'statusAktif' => $this->request->getVar('statusAktif'),
    ];

    log_message('debug', 'Data yang akan diperbarui: ' . json_encode($data));

    // Update data warga
    if ($this->wargaModel->update($nik, $data) === false) {
        session()->setFlashdata('error', 'Gagal memperbarui data: ' . implode(', ', $this->wargaModel->errors()));
        return redirect()->back()->withInput();
    }

    session()->setFlashdata('success', 'Data Warga berhasil diperbarui.');
    return redirect()->to(base_url('/warga'));
}


    public function delete($nik)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }

        // Temukan data warga berdasarkan NIK
        $wargaModel = new WargaModel();
        $wargaData = $wargaModel->find($nik);

        // Jika data tidak ditemukan, kembalikan dengan pesan kesalahan
        if (!$wargaData) {
            session()->setFlashdata('error', 'Data tidak ditemukan.');
            return redirect()->to(base_url('admin/warga/index'));
        }

        // Hapus data dari database
        $wargaModel->delete($nik);

        // Redirect ke halaman index dengan pesan sukses
        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to(base_url('admin/warga/index'));
    }
}
