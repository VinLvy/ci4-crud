<?php

namespace App\Controllers;

class Pegawai extends BaseController
{
    protected $model; // Declare the $model property

    function __construct()
    {
        $this->model = new \App\Models\ModelPegawai();
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return redirect()->to('pegawai');
    }

    public function edit($id)
    {
        return json_encode($this->model->find($id));
    }

    public function simpan()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'nama' => [
                'label' => 'Name',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} must be filled',
                    'min_length' => 'Minimum 3 character for {field}'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|min_length[3]|valid_email',
                'errors' => [
                    'required' => '{field} must be filled',
                    'min_length' => 'Minimum 3 character for {field}',
                    'valid_email' => 'Email not valid'
                ]
            ],
            'alamat' => [
                'label' => 'Address',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} must be filled',
                    'min_length' => 'Minimum 3 character for {field}'
                ]
            ],
        ];

        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            $id = $this->request->getPost('id');
            $nama = $this->request->getPost('nama');
            $email = $this->request->getPost('email');
            $bidang = $this->request->getPost('bidang');
            $alamat = $this->request->getPost('alamat');

            $data = [
                'id' => $id,
                'nama' => $nama,
                'email' => $email,
                'bidang' => $bidang,
                'alamat' => $alamat
            ];

            $this->model->save($data);

            $hasil['sukses'] = "Add Data Succeed";
            $hasil['error'] = true;
        } else {
            $hasil['sukses'] = false;
            $hasil['error'] = $validasi->listErrors();
        }

        return json_encode($hasil);
    }

    public function index(): string
    {
        $jumlahBaris = 3;
        $katakunci = $this->request->getGet('katakunci');
        if ($katakunci) {
            $pencarian = $this->model->cari($katakunci);
        } else {
            $pencarian = $this->model;
        }
        $data['katakunci'] = $katakunci;
        $data['dataPegawai'] = $pencarian->orderBy('id', 'desc')->paginate($jumlahBaris);
        $data['pager'] = $this->model->pager;
        $data['nomor'] = ($this->request->getVar('page') == 1) ? '0' : $this->request->getVar('page');
        return view('pegawai_view', $data);
    }
}
