<?php

namespace App\Modules\Pendaftaran\Models;

use CodeIgniter\Model;

class PendaftaranModel extends Model
{
    protected $table            = 'pendaftaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['pasien_id', 'dokter_id', 'poli_id', 'tanggal_daftar', 'keluhan', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getPendaftaranComplete()
    {
        return $this->db->table($this->table)
            ->select('pendaftaran.*, pasien.nama_pasien as nama, dokter.nama_dokter, poli.nama_poli')
            ->join('pasien', 'pasien.id = pendaftaran.pasien_id')
            ->join('dokter', 'dokter.id = pendaftaran.dokter_id')
            ->join('poli', 'poli.id = pendaftaran.poli_id')
            ->get()
            ->getResultArray();
    }
}
