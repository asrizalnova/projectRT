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

        // Tambahkan logika perhitungan umur
        foreach ($all_data_warga as $key => $warga) {
            $tanggal_lahir = new \DateTime($warga->tanggalLahir); // Ambil tanggal lahir
            $sekarang = new \DateTime(); // Tanggal saat ini
            $umur = $sekarang->diff($tanggal_lahir)->y; // Hitung selisih tahun
            $all_data_warga[$key]->umur = $umur; // Simpan umur ke dalam data warga
        }

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
        // Ambil nomor KK dari input
        $noKk = $this->request->getVar('noKk');

        // Validasi no KK apakah sudah terdaftar
        $kkExists = $this->kkModel->where('noKk', $noKk)->first();
        if (!$kkExists) {
            // Jika nomor KK tidak ditemukan, tampilkan pesan error
            session()->setFlashdata('error', 'No KK tidak ditemukan.');
            return redirect()->back()->withInput();
        }

        // Validasi input lainnya
        $validation = $this->validate([
            'nik' => [
                'rules'  => 'required|is_unique[tbl_warga.nik]',
                'errors' => [
                    'required' => 'Masukkan NIK.',
                    'is_unique' => 'NIK sudah terdaftar.'
                ]
            ],
            'noKk' => [
                'rules'  => 'required|exact_length[16]',
                'errors' => [
                    'required' => 'Masukkan nomor KK.',
                    'exact_length' => 'Nomor KK harus berjumlah 16 karakter.'
                ]
            ],
            'nama' => [
                'rules'  => 'required|max_length[45]',
                'errors' => [
                    'required' => 'Masukkan nama.',
                    'max_length' => 'Nama tidak boleh lebih dari 45 karakter.'
                ]
            ],
            'jenisKelamin' => [
                'rules'  => 'required|in_list[Laki-Laki,Perempuan]',
                'errors' => [
                    'required' => 'Pilih jenis kelamin.',
                    'in_list' => 'Jenis kelamin harus Laki-Laki atau Perempuan.'
                ]
            ],
            'tempatLahir' => [
                'rules'  => 'required|max_length[36]',
                'errors' => [
                    'required' => 'Masukkan tempat lahir.',
                    'max_length' => 'Tempat lahir tidak boleh lebih dari 36 karakter.'
                ]
            ],
            'tanggalLahir' => [
                'rules'  => 'required|valid_date[Y-m-d]',
                'errors' => [
                    'required' => 'Masukkan tanggal lahir.',
                    'valid_date' => 'Tanggal lahir harus dalam format YYYY-MM-DD.'
                ]
            ],
            'status' => [
                'rules'  => 'required|in_list[Kepala Keluarga,Istri,Anak]',
                'errors' => [
                    'required' => 'Pilih status keluarga.',
                    'in_list' => 'Status harus salah satu dari: Kepala Keluarga, Istri, Anak.'
                ]
            ],
            'pekerjaan' => [
                'rules'  => 'required|max_length[72]',
                'errors' => [
                    'required' => 'Masukkan pekerjaan.',
                    'max_length' => 'Pekerjaan tidak boleh lebih dari 72 karakter.'
                ]
            ],
            'keterangan' => [
                'rules'  => 'max_length[255]',
                'errors' => [
                    'max_length' => 'Keterangan tidak boleh lebih dari 255 karakter.'
                ]
            ],
            'statusAktif' => [
                'rules'  => 'required|in_list[Aktif,Pindah,Meninggal]',
                'errors' => [
                    'required' => 'Pilih status aktif.',
                    'in_list' => 'Status aktif harus salah satu dari: Aktif, Pindah, Meninggal.'
                ]
            ],
        ]);

        // Jika validasi gagal
        if (!$validation) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        // Jika validasi berhasil, simpan data
        $data = [
            'nik' => $this->request->getPost('nik'),
            'noKk' => $noKk,
            'nama' => $this->request->getPost('nama'),
            'jenisKelamin' => $this->request->getPost('jenisKelamin'),
            'tempatLahir' => $this->request->getPost('tempatLahir'),
            'tanggalLahir' => $this->request->getPost('tanggalLahir'),
            'status' => $this->request->getPost('status'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'keterangan' => $this->request->getPost('keterangan'),
            'statusAktif' => $this->request->getPost('statusAktif'),
        ];

        // Simpan data ke database
        if ($this->wargaModel->insert($data) === false) {
            session()->setFlashdata('error', 'Gagal menambahkan data: ' . implode(', ', $this->wargaModel->errors()));
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('success', 'Data Warga berhasil ditambahkan.');
            return redirect()->to(base_url('/warga'));
        }
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
        return redirect()->to(base_url('/warga'));
    }
}
