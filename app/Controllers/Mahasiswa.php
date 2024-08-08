<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use CodeIgniter\Controller;

class Mahasiswa extends Controller
{
    public function index()
    {
        $model = new MahasiswaModel();
        $data['mahasiswa'] = $model->findAll();
        return view('mahasiswa/index', $data);
    }

    public function create()
    {
        return view('mahasiswa/create');
    }

    public function store()
    {
        $model = new MahasiswaModel();

        $fileFotoDiri = $this->request->getFile('foto_diri');
        $fileFotoKTP = $this->request->getFile('foto_ktp');

        if ($fileFotoDiri->isValid() && !$fileFotoDiri->hasMoved()) {
            $fileFotoDiri->move('uploads');
        }

        if ($fileFotoKTP->isValid() && !$fileFotoKTP->hasMoved()) {
            $fileFotoKTP->move('uploads');
        }

        $data = [
            'nim' => $this->request->getPost('nim'),
            'nama' => $this->request->getPost('nama'),
            'foto_diri' => $fileFotoDiri->getName(),
            'foto_ktp' => $fileFotoKTP->getName(),
        ];

        $model->save($data);

        return redirect()->to('/mahasiswa');
    }

    public function edit($id)
    {
        $model = new MahasiswaModel();
        $data['mahasiswa'] = $model->find($id);
        return view('mahasiswa/edit', $data);
    }

    public function update($id)
    {
        $model = new MahasiswaModel();

        $fileFotoDiri = $this->request->getFile('foto_diri');
        $fileFotoKTP = $this->request->getFile('foto_ktp');

        $mahasiswa = $model->find($id);

        $data = [
            'nim' => $this->request->getPost('nim'),
            'nama' => $this->request->getPost('nama'),
        ];

        if ($fileFotoDiri->isValid() && !$fileFotoDiri->hasMoved()) {
            $fileFotoDiri->move('uploads');
            $data['foto_diri'] = $fileFotoDiri->getName();
        } else {
            $data['foto_diri'] = $mahasiswa['foto_diri'];
        }

        if ($fileFotoKTP->isValid() && !$fileFotoKTP->hasMoved()) {
            $fileFotoKTP->move('uploads');
            $data['foto_ktp'] = $fileFotoKTP->getName();
        } else {
            $data['foto_ktp'] = $mahasiswa['foto_ktp'];
        }

        $model->update($id, $data);

        return redirect()->to('/mahasiswa');
    }

    public function delete($id)
    {
        $model = new MahasiswaModel();
        $model->delete($id);
        return redirect()->to('/mahasiswa');
    }
}
