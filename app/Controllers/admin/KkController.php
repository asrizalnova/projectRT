<?php

namespace App\Controllers\admin;

use App\Models\KkModel;
use CodeIgniter\Controller;

class KkController extends Controller
{
    public function index()
    {
        $kkModel = new KkModel();
        $data['kartu_keluarga'] = $kkModel->findAll();

        return view('admin/KK/viewKK', $data);
    }

    public function create()
    {
        return view('admin/KK/createKK');
    }

    public function store()
{
    helper(['form', 'url']);
    $validation = $this->validate([
        'noKK' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Masukkan nomor kartu keluarga.'
            ]
        ],
        'namaKK' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Masukkan nama kepala keluarga.'
            ]
        ],
        'status' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Isi status.'
            ]
        ],
    ]);

    if (!$validation) {
        // Jika validasi gagal, kembalikan ke view create dengan pesan error
        return view('admin/KK/createKK', [
            'validation' => $this->validator
        ]);
    } else {
        $kkModel = new KkModel();
        if ($kkModel->insert([
            'noKK'   => $this->request->getPost('noKK'),
            'namaKK' => $this->request->getPost('namaKK'),
            'status' => $this->request->getPost('status'),
        ])) {
            // Simpan pesan sukses untuk ditampilkan di index
            session()->setFlashdata('success', 'Data Berhasil Disimpan');
        } else {
            // Simpan pesan error untuk ditampilkan di create
            session()->setFlashdata('error', 'Gagal Menyimpan Data');
        }
        return redirect()->to(base_url('/kk'));
    }
}

    public function edit($noKK)
    {
        $kkModel = new KkModel();
        $data['kk'] = $kkModel->find($noKK);

        if (!$data['kk']) {
            return redirect()->to('/kk')->with('message', 'Data tidak ditemukan');
        }

        return view('admin/KK/editKK', $data);
    }

    public function update($noKK)
    {
        helper(['form', 'url']);
        $validation = $this->validate([
            'namaKK'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan nama kepala keluarga.'
                ]
            ],
            'status'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Isi status.'
                ]
            ],
        ]);

        $kkModel = new KkModel();

        if (!$validation) {
            return view('admin/KK/editKK', [
                'validation' => $this->validator,
                'kk'         => $kkModel->find($noKK)
            ]);
        } else {
            if ($kkModel->update($noKK, [
                'namaKK' => $this->request->getPost('namaKK'),
                'status' => $this->request->getPost('status'),
            ])) {
                session()->setFlashdata('message', 'Data Berhasil Diperbarui');
            } else {
                session()->setFlashdata('message', 'Gagal Memperbarui Data');
            }
            return redirect()->to(base_url('/kk'));
        }
    }

    public function delete($noKK)
    {
        $kkModel = new KkModel();

        if (!$kkModel->find($noKK)) {
            return redirect()->to('/kk')->with('message', 'Data tidak ditemukan');
        }

        if ($kkModel->delete($noKK)) {
            session()->setFlashdata('message', 'Data Berhasil Dihapus');
        } else {
            session()->setFlashdata('message', 'Gagal Menghapus Data');
        }

        return redirect()->to(base_url('/kk'));
    }
}
