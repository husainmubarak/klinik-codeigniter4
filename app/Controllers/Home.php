<?php

namespace App\Controllers;

use App\Module\Pasien\Models\PasienModel;

class Home extends BaseController
{
    public function index(): string
    {
        $pasienModel = new PasienModel();
        
        // Cek apakah tabel pasien sudah ada (untuk menghindari error sebelum migrasi dijalankan)
        $db = \Config\Database::connect();
        $recentPatients = [];
        $stats = [
            'total' => 0,
            'laki'  => 0,
            'perempuan' => 0,
        ];

        if ($db->tableExists('pasien')) {
            $stats['total'] = $pasienModel->countAllResults();
            $stats['laki'] = $pasienModel->where('jenis_kelamin', 'Laki-laki')->countAllResults();
            $stats['perempuan'] = $pasienModel->where('jenis_kelamin', 'Perempuan')->countAllResults();
            $recentPatients = $pasienModel->orderBy('created_at', 'DESC')->limit(5)->find();
        }

        $data = [
            'title' => 'Dashboard KlinikPro',
            'stats' => $stats,
            'recentPatients' => $recentPatients,
        ];

        return view('dashboard', $data);
    }
}

