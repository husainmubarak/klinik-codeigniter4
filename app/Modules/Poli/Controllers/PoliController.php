<?php

namespace App\Modules\Poli\Controllers;

use App\Controllers\BaseController;
use App\Modules\Poli\Models\PoliModel;

class PoliController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PoliModel();
    }

    public function index()
    {
        $data['polis'] = $this->model->findAll();
        $data['title'] = 'Data Poli';
        return view('App\Modules\Poli\Views\index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Poli';
        $data['validation'] = \Config\Services::validation();
        return view('App\Modules\Poli\Views\create', $data);
    }

    public function store()
    {
        $rules = [
            'nama_poli' => [
                'rules' => 'required|max_length[100]|is_unique[poli.nama_poli]',
                'errors' => [
                    'required' => 'Nama poli harus diisi',
                    'max_length' => 'Nama poli maksimal 100 karakter',
                    'is_unique' => 'Nama poli sudah ada'
                ]
            ],
            'keterangan' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $this->model->save([
            'nama_poli' => $this->request->getPost('nama_poli'),
            'keterangan' => $this->request->getPost('keterangan')
        ]);

        return redirect()->to('/poli')->with('success', 'Data poli berhasil ditambahkan');
    }

    public function edit($id = null)
    {
        $data['poli'] = $this->model->find($id);
        if (empty($data['poli'])) {
            return redirect()->to('/poli');
        }
        $data['title'] = 'Edit Poli';
        $data['validation'] = \Config\Services::validation();
        return view('App\Modules\Poli\Views\edit', $data);
    }

    public function update($id = null)
    {
        $poli = $this->model->find($id);
        
        $rule_nama = 'required|max_length[100]';
        if ($poli['nama_poli'] != $this->request->getPost('nama_poli')) {
            $rule_nama .= '|is_unique[poli.nama_poli]';
        }

        $rules = [
            'nama_poli' => [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => 'Nama poli harus diisi',
                    'max_length' => 'Nama poli maksimal 100 karakter',
                    'is_unique' => 'Nama poli sudah ada'
                ]
            ],
            'keterangan' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $this->model->update($id, [
            'nama_poli' => $this->request->getPost('nama_poli'),
            'keterangan' => $this->request->getPost('keterangan')
        ]);

        return redirect()->to('/poli')->with('success', 'Data poli berhasil diperbarui');
    }

    public function delete($id = null)
    {
        $this->model->delete($id);
        return redirect()->to('/poli')->with('success', 'Data poli berhasil dihapus');
    }
}
