<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pendaftaran</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
        h2, h4 { margin: 5px 0; }
    </style>
</head>
<body>
    <div class="text-center">
        <h2>Klinik Sederhana</h2>
        <h4>Laporan Pendaftaran</h4>
        <p>Periode: <?= date('d-m-Y', strtotime($tgl_awal)) ?> s/d <?= date('d-m-Y', strtotime($tgl_akhir)) ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pasien</th>
                <th>Poli</th>
                <th>Dokter</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($pendaftarans)): ?>
                <tr><td colspan="6" class="text-center">Tidak ada data pendaftaran.</td></tr>
            <?php else: ?>
                <?php $i = 1; foreach($pendaftarans as $p): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= date('d-m-Y', strtotime($p['tanggal_daftar'])) ?></td>
                    <td><?= esc($p['nama'] ?? '') ?></td>
                    <td><?= esc($p['nama_poli']) ?></td>
                    <td><?= esc($p['nama_dokter']) ?></td>
                    <td><?= ucfirst($p['status']) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
