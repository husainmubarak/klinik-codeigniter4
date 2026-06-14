<?php

namespace App\Module\Pasien\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table            = 'pasien';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'no_rm',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'no_rm'         => 'required|max_length[20]',
        'nama'          => 'required|max_length[100]',
        'jenis_kelamin' => 'required|in_list[Laki-laki,Perempuan]',
        'tanggal_lahir' => 'required|valid_date',
        'alamat'        => 'required',
    ];

    protected $validationMessages = [
        'no_rm' => [
            'required'   => 'Nomor Rekam Medis wajib diisi.',
            'max_length' => 'Nomor Rekam Medis maksimal 20 karakter.',
        ],
        'nama' => [
            'required'   => 'Nama pasien wajib diisi.',
            'max_length' => 'Nama pasien maksimal 100 karakter.',
        ],
        'jenis_kelamin' => [
            'required' => 'Jenis kelamin wajib dipilih.',
            'in_list'  => 'Jenis kelamin tidak valid.',
        ],
        'tanggal_lahir' => [
            'required'   => 'Tanggal lahir wajib diisi.',
            'valid_date' => 'Format tanggal lahir tidak valid.',
        ],
        'alamat' => [
            'required' => 'Alamat wajib diisi.',
        ],
    ];

    protected $skipValidation = false;
}
