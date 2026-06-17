<?php

namespace App\Modules\Pemeriksaan\Models;

use CodeIgniter\Model;

class PemeriksaanModel extends Model
{
    protected $table            = 'pemeriksaan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'pendaftaran_id',
        'diagnosa',
        'tindakan',
        'resep_obat',
        'catatan',
        'tanggal_periksa'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getPemeriksaanComplete()
    {
        return $this->select('pemeriksaan.*, pendaftaran.tanggal_daftar, pasien.nama_pasien, pasien.no_rm, dokter.nama_dokter, poli.nama_poli')
            ->join('pendaftaran', 'pendaftaran.id = pemeriksaan.pendaftaran_id')
            ->join('pasien', 'pasien.id = pendaftaran.pasien_id')
            ->join('dokter', 'dokter.id = pendaftaran.dokter_id')
            ->join('poli', 'poli.id = pendaftaran.poli_id')
            ->orderBy('pemeriksaan.tanggal_periksa', 'DESC')
            ->findAll();
    }
}
