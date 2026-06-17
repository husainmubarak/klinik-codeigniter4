<?php

namespace App\Modules\Dokter\Models;

use CodeIgniter\Model;

class DokterModel extends Model
{
    protected $table            = 'dokter';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_dokter', 'spesialisasi', 'no_telepon', 'email', 'poli_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getDokterWithPoli()
    {
        return $this->db->table($this->table)
            ->select('dokter.*, poli.nama_poli')
            ->join('poli', 'poli.id = dokter.poli_id')
            ->get()
            ->getResultArray();
    }
}
