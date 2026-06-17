<?php

namespace App\Modules\Pendaftaran\Controllers;

use App\Controllers\BaseController;
use App\Modules\Pendaftaran\Models\PendaftaranModel;
use App\Modules\Pasien\Models\PasienModel;
use App\Modules\Dokter\Models\DokterModel;
use App\Modules\Poli\Models\PoliModel;

class PendaftaranController extends BaseController
{
    protected $model;
    protected $pasienModel;
    protected $dokterModel;
    protected $poliModel;

    public function __construct()
    {
        $this->model = new PendaftaranModel();
        $this->pasienModel = new PasienModel();
        $this->dokterModel = new DokterModel();
        $this->poliModel = new PoliModel();
    }

    public function index()
    {
        $data['pendaftarans'] = $this->model->getPendaftaranComplete();
        $data['title'] = 'Data Pendaftaran';
        return view('App\Modules\Pendaftaran\Views\index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Pendaftaran';
        $data['pasiens'] = $this->pasienModel->findAll();
        $data['dokters'] = $this->dokterModel->findAll();
        $data['polis'] = $this->poliModel->findAll();
        $data['validation'] = \Config\Services::validation();
        return view('App\Modules\Pendaftaran\Views\create', $data);
    }

    public function new()
    {
        return $this->create();
    }

    public function store()
    {
        $rules = [
            'pasien_id' => 'required|integer',
            'dokter_id' => 'required|integer',
            'poli_id' => 'required|integer',
            'tanggal_daftar' => 'required|valid_date',
            'keluhan' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $this->model->save([
            'pasien_id' => $this->request->getPost('pasien_id'),
            'dokter_id' => $this->request->getPost('dokter_id'),
            'poli_id' => $this->request->getPost('poli_id'),
            'tanggal_daftar' => $this->request->getPost('tanggal_daftar'),
            'keluhan' => $this->request->getPost('keluhan'),
            'status' => 'menunggu'
        ]);

        return redirect()->to('/pendaftaran')->with('success', 'Data pendaftaran berhasil ditambahkan');
    }

    public function edit($id = null)
    {
        $data['pendaftaran'] = $this->model->find($id);
        if (empty($data['pendaftaran'])) {
            return redirect()->to('/pendaftaran');
        }
        $data['title'] = 'Edit Pendaftaran';
        $data['pasiens'] = $this->pasienModel->findAll();
        $data['dokters'] = $this->dokterModel->findAll();
        $data['polis'] = $this->poliModel->findAll();
        $data['validation'] = \Config\Services::validation();
        return view('App\Modules\Pendaftaran\Views\edit', $data);
    }

    public function update($id = null)
    {
        $rules = [
            'pasien_id' => 'required|integer',
            'dokter_id' => 'required|integer',
            'poli_id' => 'required|integer',
            'tanggal_daftar' => 'required|valid_date',
            'keluhan' => 'required',
            'status' => 'required|in_list[menunggu,selesai,batal]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $this->model->update($id, [
            'pasien_id' => $this->request->getPost('pasien_id'),
            'dokter_id' => $this->request->getPost('dokter_id'),
            'poli_id' => $this->request->getPost('poli_id'),
            'tanggal_daftar' => $this->request->getPost('tanggal_daftar'),
            'keluhan' => $this->request->getPost('keluhan'),
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->to('/pendaftaran')->with('success', 'Data pendaftaran berhasil diperbarui');
    }

    public function delete($id = null)
    {
        $this->model->delete($id);
        return redirect()->to('/pendaftaran')->with('success', 'Data pendaftaran berhasil dihapus');
    }
}
