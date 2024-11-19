<?php

namespace App\Controllers;

use App\Models\KasModel;
use CodeIgniter\Controller;

class KasController extends Controller
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Sesuaikan dengan halaman login
        }

        $model = new KasModel();

        // Mengambil data dengan urutan terbaru di atas
        $data['kas_detail'] = $model->orderBy('idKas', 'ASC')->findAll();

        return view('admin/kas', $data);
    }


    public function store()
    {
        helper(['form', 'url']);
        $model = new KasModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'namaKas' => 'required',
            'jenis' => 'required',
            'saldo' => 'required|decimal'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal
            return $this->response->setJSON(['status' => false, 'errors' => $validation->getErrors()]);
        }

        // Data valid, simpan ke database
        $data = [
            'namaKas' => $this->request->getVar('namaKas'),
            'jenis' => $this->request->getVar('jenis'),
            'saldo' => $this->request->getVar('saldo'),
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

    public function edit($id)
    {
        $model = new KasModel();
        $data = $model->find($id);
        return $this->response->setJSON($data); // Mengirim data sebagai JSON untuk ditampilkan di modal
    }

    public function update($id)
    {
        helper(['form', 'url']);
        $model = new KasModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'namaKas' => 'required',
            'jenis' => 'required',
            'saldo' => 'required|decimal'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['status' => false, 'errors' => $validation->getErrors()]);
        }

        // Update data di database
        $data = [
            'namaKas' => $this->request->getVar('namaKas'),
            'jenis' => $this->request->getVar('jenis'),
            'saldo' => $this->request->getVar('saldo'),
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
        $model = new KasModel();

        if ($model->find($id)) {
            $model->delete($id);
            return $this->response->setJSON(['status' => true, 'redirect' => site_url('kas')]);
        } else {
            return $this->response->setJSON(['status' => false, 'redirect' => site_url('kas')]);
        }
    }
}
