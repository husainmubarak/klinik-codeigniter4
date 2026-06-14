<?php

namespace App\Module\Pasien\Controllers;

use App\Controllers\BaseController;
use App\Module\Pasien\Models\PasienModel;

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

        return view('App\Module\Pasien\Views\index', $data);
    }

    /**
     * Menampilkan form tambah pasien baru.
     */
    public function create()
    {
        $data = [
            'title'      => 'Tambah Pasien Baru',
            'validation' => session()->getFlashdata('validation'),
        ];

        return view('App\Module\Pasien\Views\create', $data);
    }

    /**
     * Menyimpan data pasien baru.
     */
    public function store()
    {
        $rules = [
            'no_rm'         => 'required|max_length[20]|is_unique[pasien.no_rm]',
            'nama'          => 'required|max_length[100]',
            'jenis_kelamin' => 'required|in_list[Laki-laki,Perempuan]',
            'tanggal_lahir' => 'required|valid_date',
            'alamat'        => 'required',
            'no_telepon'    => 'permit_empty|max_length[20]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $this->pasienModel->save([
            'no_rm'         => $this->request->getPost('no_rm'),
            'nama'          => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'alamat'        => $this->request->getPost('alamat'),
            'no_telepon'    => $this->request->getPost('no_telepon'),
        ]);

        return redirect()->to('/pasien')->with('success', 'Data pasien berhasil ditambahkan.');
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

        return view('App\Module\Pasien\Views\show', $data);
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

        return view('App\Module\Pasien\Views\edit', $data);
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
            'nama'          => 'required|max_length[100]',
            'jenis_kelamin' => 'required|in_list[Laki-laki,Perempuan]',
            'tanggal_lahir' => 'required|valid_date',
            'alamat'        => 'required',
            'no_telepon'    => 'permit_empty|max_length[20]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $this->pasienModel->update($id, [
            'no_rm'         => $this->request->getPost('no_rm'),
            'nama'          => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'alamat'        => $this->request->getPost('alamat'),
            'no_telepon'    => $this->request->getPost('no_telepon'),
        ]);

        return redirect()->to('/pasien')->with('success', 'Data pasien berhasil diperbarui.');
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

        $this->pasienModel->delete($id);

        return redirect()->to('/pasien')->with('success', 'Data pasien berhasil dihapus.');
    }
}
