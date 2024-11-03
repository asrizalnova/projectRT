<?php

namespace App\Controllers;

use App\Models\KkModel;
use CodeIgniter\Controller;

class KkController extends Controller
{
    public function View()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }

        $kkModel = new KkModel();
        $data['kk_detail'] = $kkModel->findAll();

        return view('admin/kk', $data);
    }

    public function store()
    {
        helper(['form', 'url']);
        $model = new KkModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'noKK'   => 'required|exact_length[16]',
            'namaKK' => 'required|max_length[45]',
            'status' => 'required|in_list[Menetap,Pindah]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal
            return $this->response->setJSON(['status' => false, 'errors' => $validation->getErrors()]);
        }

        // Data valid, simpan ke database
        $data = [
            'noKK' => $this->request->getVar('noKK'),
            'namaKK' => $this->request->getVar('namaKK'),
            'status' => $this->request->getVar('status'),
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

    public function edit($noKK)
    {
        $model = new KkModel();
        $data = $model->find($noKK);
        return $this->response->setJSON($data); // Mengirim data sebagai JSON untuk ditampilkan di modal
    }

    public function update($noKK)
    {
        helper(['form', 'url']);
        $model = new KkModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'noKK'   => 'required|exact_length[16]',
            'namaKK' => 'required|max_length[45]',
            'status' => 'required|in_list[Menetap,Pindah]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['status' => false, 'errors' => $validation->getErrors()]);
        }

        // Update data di database
        $data = [
            'noKK' => $this->request->getVar('noKK'),
            'namaKK' => $this->request->getVar('namaKK'),
            'status' => $this->request->getVar('status'),
        ];

        $update = $model->update($noKK, $data);

        if ($update === false) {
            return $this->response->setJSON(['status' => false, 'message' => 'Gagal memperbarui data.']);
        } else {
            return $this->response->setJSON(['status' => true, 'message' => 'Data berhasil diperbarui.']);
        }
    }

    // public function delete($id)
    // {
    //     $model = new KkModel();

    //     if ($model->find($id)) {
    //         $model->delete($id);
    //         return $this->response->setJSON(['status' => true, 'redirect' => site_url('kk')]);
    //     } else {
    //         return $this->response->setJSON(['status' => false, 'redirect' => site_url('kk')]);
    //     }
    // }

    public function delete($noKK)
    {
        $kkModel = new KkModel();

        if (!$kkModel->find($noKK)) {
            return redirect()->to('/kk')->with('message', 'Data tidak ditemukan');
        }

        if ($kkModel->delete($noKK) === false) {
            session()->setFlashdata('error', 'Data Berhasil Dihapus');
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('success', 'Data Berhasil Dihapus');
            return redirect()->to(base_url('/kk'));
        }
    }
}
