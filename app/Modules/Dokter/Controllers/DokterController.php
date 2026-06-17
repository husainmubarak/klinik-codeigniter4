<?php

namespace App\Modules\Dokter\Controllers;

use App\Controllers\BaseController;
use App\Modules\Dokter\Models\DokterModel;
use App\Modules\Poli\Models\PoliModel;

class DokterController extends BaseController
{
    protected $model;
    protected $poliModel;

    public function __construct()
    {
        $this->model = new DokterModel();
        $this->poliModel = new PoliModel();
    }

    public function index()
    {
        $data['dokters'] = $this->model->getDokterWithPoli();
        $data['title'] = 'Data Dokter';
        return view('App\Modules\Dokter\Views\index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Dokter';
        $data['polis'] = $this->poliModel->findAll();
        $data['validation'] = \Config\Services::validation();
        return view('App\Modules\Dokter\Views\create', $data);
    }

    public function new()
    {
        return $this->create();
    }

    public function store()
    {
        $rules = [
            'nama_dokter' => 'required|max_length[100]',
            'spesialisasi' => 'required',
            'poli_id' => 'required|integer',
            'no_telepon' => 'permit_empty|numeric',
            'email' => 'permit_empty|valid_email|is_unique[dokter.email]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $this->model->save([
            'nama_dokter' => $this->request->getPost('nama_dokter'),
            'spesialisasi' => $this->request->getPost('spesialisasi'),
            'poli_id' => $this->request->getPost('poli_id'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'email' => $this->request->getPost('email')
        ]);

        return redirect()->to('dokter')->with('success', 'Data dokter berhasil ditambahkan');
    }

    public function edit($id = null)
    {
        $data['dokter'] = $this->model->find($id);
        if (empty($data['dokter'])) {
            return redirect()->to('dokter');
        }
        $data['title'] = 'Edit Dokter';
        $data['polis'] = $this->poliModel->findAll();
        $data['validation'] = \Config\Services::validation();
        return view('App\Modules\Dokter\Views\edit', $data);
    }

    public function update($id = null)
    {
        $dokter = $this->model->find($id);
        
        $rule_email = 'permit_empty|valid_email';
        if ($dokter['email'] != $this->request->getPost('email') && !empty($this->request->getPost('email'))) {
            $rule_email .= '|is_unique[dokter.email]';
        }

        $rules = [
            'nama_dokter' => 'required|max_length[100]',
            'spesialisasi' => 'required',
            'poli_id' => 'required|integer',
            'no_telepon' => 'permit_empty|numeric',
            'email' => $rule_email
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $this->model->update($id, [
            'nama_dokter' => $this->request->getPost('nama_dokter'),
            'spesialisasi' => $this->request->getPost('spesialisasi'),
            'poli_id' => $this->request->getPost('poli_id'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'email' => $this->request->getPost('email')
        ]);

        return redirect()->to('dokter')->with('success', 'Data dokter berhasil diperbarui');
    }

    public function delete($id = null)
    {
        $this->model->delete($id);
        return redirect()->to('dokter')->with('success', 'Data dokter berhasil dihapus');
    }
}
