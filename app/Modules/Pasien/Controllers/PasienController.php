<?php

namespace App\Modules\Pasien\Controllers;

use App\Controllers\BaseController;
use App\Modules\Pasien\Models\PasienModel;

class PasienController extends BaseController
{
    protected PasienModel $pasienModel;

    public function __construct()
    {
        $this->pasienModel = new PasienModel();
    }

    /**
     * Menampilkan daftar semua pasien.
     */
    public function index()
    {
        $data = [
            'title'   => 'Daftar Pasien',
            'pasien'  => $this->pasienModel->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('App\Modules\Pasien\Views\index', $data);
    }

    public function new()
    {
        $data = [
            'title' => 'Tambah Pasien',
            'no_rm' => $this->generateNoRm(),
            'validation' => \Config\Services::validation()
        ];
        return view('App\Modules\Pasien\Views\create', $data);
    }

    private function generateNoRm()
    {
        $lastPasien = $this->pasienModel->orderBy('id', 'DESC')->first();
        $nextId = $lastPasien ? $lastPasien['id'] + 1 : 1;
        return 'RM-' . date('Ym') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Menyimpan data pasien baru.
     */
    public function create()
    {
        $rules = [
            'no_rm'         => 'required|max_length[20]|is_unique[pasien.no_rm]',
            'nama_pasien'   => 'required|max_length[100]',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'tanggal_lahir' => 'required|valid_date',
            'alamat'        => 'required',
            'no_telepon'    => 'permit_empty|max_length[20]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $this->pasienModel->save([
            'no_rm'         => $this->request->getPost('no_rm'),
            'nama_pasien'   => $this->request->getPost('nama_pasien'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'alamat'        => $this->request->getPost('alamat'),
            'no_telepon'    => $this->request->getPost('no_telepon'),
        ]);

        return redirect()->to('pasien')->with('success', 'Data pasien berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail pasien.
     */
    public function show($id = null)
    {
        $pasien = $this->pasienModel->find($id);

        if (! $pasien) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data pasien tidak ditemukan.');
        }

        $data = [
            'title'  => 'Detail Pasien',
            'pasien' => $pasien,
        ];

        return view('App\Modules\Pasien\Views\show', $data);
    }

    /**
     * Menampilkan form edit pasien.
     */
    public function edit($id = null)
    {
        $pasien = $this->pasienModel->find($id);

        if (! $pasien) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data pasien tidak ditemukan.');
        }

        $data = [
            'title'      => 'Edit Data Pasien',
            'pasien'     => $pasien,
            'validation' => session()->getFlashdata('validation'),
        ];

        return view('App\Modules\Pasien\Views\edit', $data);
    }

    /**
     * Mengupdate data pasien.
     */
    public function update($id = null)
    {
        $pasien = $this->pasienModel->find($id);

        if (! $pasien) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data pasien tidak ditemukan.');
        }

        $rules = [
            'no_rm'         => "required|max_length[20]|is_unique[pasien.no_rm,id,{$id}]",
            'nama_pasien'   => 'required|max_length[100]',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'tanggal_lahir' => 'required|valid_date',
            'alamat'        => 'required',
            'no_telepon'    => 'permit_empty|max_length[20]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $this->pasienModel->update($id, [
            'no_rm'         => $this->request->getPost('no_rm'),
            'nama_pasien'   => $this->request->getPost('nama_pasien'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'alamat'        => $this->request->getPost('alamat'),
            'no_telepon'    => $this->request->getPost('no_telepon'),
        ]);

        return redirect()->to('pasien')->with('success', 'Data pasien berhasil diperbarui.');
    }

    /**
     * Menghapus data pasien.
     */
    public function delete($id = null)
    {
        $pasien = $this->pasienModel->find($id);

        if (! $pasien) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data pasien tidak ditemukan.');
        }

        $pendaftaranModel = new \App\Modules\Pendaftaran\Models\PendaftaranModel();
        if ($pendaftaranModel->where('pasien_id', $id)->first()) {
            return redirect()->to('pasien')->with('error', 'Gagal menghapus! Pasien tidak dapat dihapus karena memiliki riwayat pendaftaran.');
        }

        $this->pasienModel->delete($id);

        return redirect()->to('pasien')->with('success', 'Data pasien berhasil dihapus.');
    }
}
