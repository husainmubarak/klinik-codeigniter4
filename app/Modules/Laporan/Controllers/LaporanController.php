<?php

namespace App\Modules\Laporan\Controllers;

use App\Controllers\BaseController;
use App\Modules\Pendaftaran\Models\PendaftaranModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class LaporanController extends BaseController
{
    public function index()
    {
        $model = new PendaftaranModel();
        
        $tgl_awal = $this->request->getGet('tgl_awal') ?? date('Y-m-01');
        $tgl_akhir = $this->request->getGet('tgl_akhir') ?? date('Y-m-t');
        
        $data['pendaftarans'] = $model->select('pendaftaran.*, pasien.nama_pasien as nama, dokter.nama_dokter, poli.nama_poli')
            ->join('pasien', 'pasien.id = pendaftaran.pasien_id')
            ->join('dokter', 'dokter.id = pendaftaran.dokter_id')
            ->join('poli', 'poli.id = pendaftaran.poli_id')
            ->where('tanggal_daftar >=', $tgl_awal)
            ->where('tanggal_daftar <=', $tgl_akhir)
            ->get()
            ->getResultArray();
            
        $data['tgl_awal'] = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;
        $data['title'] = 'Laporan Pendaftaran';
        
        return view('App\Modules\Laporan\Views\index', $data);
    }

    public function exportPdf()
    {
        $model = new PendaftaranModel();
        
        $tgl_awal = $this->request->getGet('tgl_awal') ?? date('Y-m-01');
        $tgl_akhir = $this->request->getGet('tgl_akhir') ?? date('Y-m-t');
        
        $data['pendaftarans'] = $model->select('pendaftaran.*, pasien.nama_pasien as nama, dokter.nama_dokter, poli.nama_poli')
            ->join('pasien', 'pasien.id = pendaftaran.pasien_id')
            ->join('dokter', 'dokter.id = pendaftaran.dokter_id')
            ->join('poli', 'poli.id = pendaftaran.poli_id')
            ->where('tanggal_daftar >=', $tgl_awal)
            ->where('tanggal_daftar <=', $tgl_akhir)
            ->get()
            ->getResultArray();
            
        $data['tgl_awal'] = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;
        
        $html = view('App\Modules\Laporan\Views\pdf', $data);
        
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        
        $dompdf->stream("laporan_pendaftaran_{$tgl_awal}_{$tgl_akhir}.pdf", ["Attachment" => true]);
    }
}
