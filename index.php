<?php
require "data/matkul.php";
require "includes/functions.php";

$nama = "Muhamad Praja Pratama";
$nim  = "3337250179";

// menyiapkan data
$baris = [];
$totalSks = 0;
$jumlahMengulang = 0;

foreach ($matkul as $mk) {
    $hasil  = hitungBobot($mk["nilai"]);
    $status = cekStatus($hasil["bobot"]);

    if ($status == "MENGULANG") {
        $jumlahMengulang++;
    }

    $totalSks += $mk["sks"];

    $baris[] = [
        "nama"   => $mk["nama"],
        "sks"    => $mk["sks"],
        "nilai"  => $mk["nilai"],
        "huruf"  => $hasil["huruf"],
        "status" => $status,
    ];
}

$ips     = hitungIps($matkul);
$maksSks = batasSks($ips);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Hasil Studi Semester 3</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="wrapper">

    <header class="header">
        <div>
            <p class="label">Kartu Hasil Studi Semester 3</p>
            <h1><?= htmlspecialchars($nama) ?></h1>
            <p class="nim">NIM <?= htmlspecialchars($nim) ?></p>
        </div>
        <div class="ips-badge">
            <span>IPS</span>
            <strong><?= number_format($ips, 2) ?></strong>
        </div>
    </header>

    <section class="card">
        <h2>Daftar Nilai</h2>

        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="kiri">Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Nilai</th>
                        <th>Huruf</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($baris as $i => $row): ?>
                        <tr class="<?= $row['status'] == 'MENGULANG' ? 'mengulang' : '' ?>">
                            <td><?= $i + 1 ?></td>
                            <td class="kiri"><?= htmlspecialchars($row["nama"]) ?></td>
                            <td><?= $row["sks"] ?></td>
                            <td><?= $row["nilai"] ?></td>
                            <td><span class="huruf huruf-<?= strtolower($row['huruf']) ?>"><?= $row["huruf"] ?></span></td>
                            <td><span class="status <?= strtolower($row['status']) ?>"><?= $row["status"] ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="ringkasan">
        <div class="kotak">
            <p>Total SKS</p>
            <strong><?= $totalSks ?></strong>
        </div>
        <div class="kotak">
            <p>IPS</p>
            <strong><?= number_format($ips, 2) ?></strong>
        </div>
        <div class="kotak">
            <p>Mengulang</p>
            <strong><?= $jumlahMengulang ?> matkul</strong>
        </div>
        <div class="kotak aksen">
            <p>SKS Semester Depan(Maks).</p>
            <strong><?= $maksSks ?> SKS</strong>
        </div>
    </section>

    <footer class="footer">
        Latihan Individu
    </footer>

</div>

</body>
</html>
