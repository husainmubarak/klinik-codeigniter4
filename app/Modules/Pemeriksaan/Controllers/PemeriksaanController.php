<?php

namespace App\Modules\Pemeriksaan\Controllers;

use App\Controllers\BaseController;
use App\Modules\Pemeriksaan\Models\PemeriksaanModel;
use App\Modules\Pendaftaran\Models\PendaftaranModel;

class PemeriksaanController extends BaseController
{
    protected $model;
    protected $pendaftaranModel;

    public function __construct()
    {
        $this->model = new PemeriksaanModel();
        $this->pendaftaranModel = new PendaftaranModel();
    }

    public function index()
    {
        $data['pemeriksaans'] = $this->model->getPemeriksaanComplete();
        $data['title'] = 'Data Pemeriksaan';
        return view('App\Modules\Pemeriksaan\Views\index', $data);
    }

    public function new()
    {
        $data['title'] = 'Tambah Pemeriksaan';
        $data['pendaftarans'] = $this->pendaftaranModel
            ->select('pendaftaran.*, pasien.nama_pasien, pasien.no_rm, poli.nama_poli')
            ->join('pasien', 'pasien.id = pendaftaran.pasien_id')
            ->join('poli', 'poli.id = pendaftaran.poli_id')
            ->where('pendaftaran.status', 'menunggu')
            ->findAll();
            
        $data['validation'] = \Config\Services::validation();
        return view('App\Modules\Pemeriksaan\Views\create', $data);
    }

    public function create()
    {
        $rules = [
            'pendaftaran_id'  => 'required|integer',
            'diagnosa'        => 'required',
            'tindakan'        => 'required',
            'resep_obat'      => 'permit_empty',
            'catatan'         => 'permit_empty',
            'tanggal_periksa' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $pendaftaran_id = $this->request->getPost('pendaftaran_id');

        $this->model->save([
            'pendaftaran_id'  => $pendaftaran_id,
            'diagnosa'        => $this->request->getPost('diagnosa'),
            'tindakan'        => $this->request->getPost('tindakan'),
            'resep_obat'      => $this->request->getPost('resep_obat'),
            'catatan'         => $this->request->getPost('catatan'),
            'tanggal_periksa' => $this->request->getPost('tanggal_periksa')
        ]);

        $this->pendaftaranModel->update($pendaftaran_id, ['status' => 'selesai']);

        return redirect()->to('pemeriksaan')->with('success', 'Data pemeriksaan berhasil ditambahkan dan status antrean otomatis diselesaikan.');
    }

    public function edit($id = null)
    {
        $data['pemeriksaan'] = $this->model->find($id);
        if (empty($data['pemeriksaan'])) {
            return redirect()->to('pemeriksaan');
        }
        $data['title'] = 'Edit Pemeriksaan';
        
        $data['pendaftarans'] = $this->pendaftaranModel
            ->select('pendaftaran.*, pasien.nama_pasien, pasien.no_rm, poli.nama_poli')
            ->join('pasien', 'pasien.id = pendaftaran.pasien_id')
            ->join('poli', 'poli.id = pendaftaran.poli_id')
            ->findAll();
            
        $data['validation'] = \Config\Services::validation();
        return view('App\Modules\Pemeriksaan\Views\edit', $data);
    }

    public function update($id = null)
    {
        $rules = [
            'pendaftaran_id'  => 'required|integer',
            'diagnosa'        => 'required',
            'tindakan'        => 'required',
            'resep_obat'      => 'permit_empty',
            'catatan'         => 'permit_empty',
            'tanggal_periksa' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $this->model->update($id, [
            'pendaftaran_id'  => $this->request->getPost('pendaftaran_id'),
            'diagnosa'        => $this->request->getPost('diagnosa'),
            'tindakan'        => $this->request->getPost('tindakan'),
            'resep_obat'      => $this->request->getPost('resep_obat'),
            'catatan'         => $this->request->getPost('catatan'),
            'tanggal_periksa' => $this->request->getPost('tanggal_periksa')
        ]);

        return redirect()->to('pemeriksaan')->with('success', 'Data pemeriksaan berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        $pemeriksaan = $this->model->find($id);
        if ($pemeriksaan) {
            $this->pendaftaranModel->update($pemeriksaan['pendaftaran_id'], ['status' => 'menunggu']);
            $this->model->delete($id);
        }
        return redirect()->to('pemeriksaan')->with('success', 'Data pemeriksaan berhasil dihapus dan status antrean dikembalikan.');
    }
}
