<?php

namespace App\Controllers\admin;

use App\Models\KasModel;
use CodeIgniter\Controller;

class KasController extends Controller
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $kasModel = new KasModel();
        $data['daftar_kas'] = $kasModel->findAll();

        return view('admin/Kas/viewKas', $data);
    }

    public function tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        return view('admin/Kas/tambahKas');
    }

    public function store()
    {
        helper(['form', 'url']);
        $validation = $this->validate([
            'namaKas' => [
                'rules'  => 'required|max_length[100]',
                'errors' => [
                    'required'   => 'Masukkan nama kas.',
                    'max_length' => 'Nama kas maksimal 100 karakter.'
                ]
            ],
            'jenis' => [
                'rules'  => 'required|in_list[Bulanan,Mingguan,Insidental]',
                'errors' => [
                    'required' => 'Pilih jenis kas.',
                    'in_list'  => 'Jenis kas harus memilih antara "Bulanan", "Mingguan", atau "Insidental".'
                ]
            ],
            'saldo' => [
                'rules'  => 'required|integer',
                'errors' => [
                    'required' => 'Masukkan saldo.',
                    'integer'  => 'Saldo harus berupa angka bulat.'
                ]
            ],
        ]);

        if (!$validation) {
            return view('admin/Kas/tambahKas', [
                'validation' => $this->validator
            ]);
        } else {
            $kasModel = new KasModel();
            if ($kasModel->insert([
                'namaKas' => $this->request->getPost('namaKas'),
                'jenis'   => $this->request->getPost('jenis'),
                'saldo'   => $this->request->getPost('saldo'),
            ]) === false) {
                session()->setFlashdata('error', 'Gagal Menyimpan Data');
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('success', 'Data Kas Berhasil Disimpan');
                return redirect()->to(base_url('/kas'));
            }
        }
    }

    public function edit($idKas)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $kasModel = new KasModel();
        $data['kas'] = $kasModel->find($idKas);

        if (!$data['kas']) {
            return redirect()->to('/kas')->with('message', 'Data tidak ditemukan');
        }

        return view('admin/Kas/editKas', $data);
    }

    public function update($idKas)
    {
        helper(['form', 'url']);
        $validation = $this->validate([
            'namaKas' => [
                'rules'  => 'required|max_length[100]',
                'errors' => [
                    'required'   => 'Masukkan nama kas.',
                    'max_length' => 'Nama kas maksimal 100 karakter.'
                ]
            ],
            'jenis' => [
                'rules'  => 'required|in_list[Bulanan,Mingguan,Insidental]',
                'errors' => [
                    'required' => 'Pilih jenis kas.',
                    'in_list'  => 'Jenis kas harus memilih antara "Bulanan", "Mingguan", atau "Insidental".'
                ]
            ],
            'saldo' => [
                'rules'  => 'required|integer',
                'errors' => [
                    'required' => 'Masukkan saldo.',
                    'integer'  => 'Saldo harus berupa angka bulat.'
                ]
            ],
        ]);

        $kasModel = new KasModel();

        if (!$validation) {
            return view('admin/Kas/editKas', [
                'validation' => $this->validator,
                'kas'        => $kasModel->find($idKas)
            ]);
        } else {
            if ($kasModel->update($idKas, [
                'namaKas' => $this->request->getPost('namaKas'),
                'jenis'   => $this->request->getPost('jenis'),
                'saldo'   => $this->request->getPost('saldo'),
            ]) === false) {
                session()->setFlashdata('error', 'Gagal memperbarui data: ' . implode(', ', $kasModel->errors()));
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('success', 'Data Kas berhasil diperbarui.');
                return redirect()->to(base_url('/kas'));
            }
        }
    }

    public function delete($idKas)
    {
        $kasModel = new KasModel();

        if (!$kasModel->find($idKas)) {
            return redirect()->to('/kas')->with('message', 'Data tidak ditemukan');
        }

        if ($kasModel->delete($idKas) === false) {
            session()->setFlashdata('error', 'Gagal menghapus data');
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('success', 'Data Kas Berhasil Dihapus');
            return redirect()->to(base_url('/kas'));
        }
    }
}
