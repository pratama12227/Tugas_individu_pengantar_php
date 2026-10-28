<?php
// konversi nilai angka ke huruf dan bobot
function hitungBobot($nilai)
{
    if ($nilai >= 80) {
        return ["huruf" => "A", "bobot" => 4.0];
    } elseif ($nilai >= 70) {
        return ["huruf" => "B", "bobot" => 3.0];
    } elseif ($nilai >= 60) {
        return ["huruf" => "C", "bobot" => 2.0];
    } elseif ($nilai >= 50) {
        return ["huruf" => "D", "bobot" => 1.0];
    }
    return ["huruf" => "E", "bobot" => 0.0];
}

// lulus kalau bobot minimal 2.0
function cekStatus($bobot)
{
    return $bobot >= 2.0 ? "LULUS" : "MENGULANG";
}

// IPS = total (sks x bobot) dibagi total sks
function hitungIps($matkul)
{
    $totalSks = 0;
    $totalMutu = 0;

    foreach ($matkul as $mk) {
        $b = hitungBobot($mk["nilai"]);
        $totalSks += $mk["sks"];
        $totalMutu += $mk["sks"] * $b["bobot"];
    }

    if ($totalSks == 0) {
        return 0;
    }
    return $totalMutu / $totalSks;
}

function batasSks($ips)
{
    if ($ips >= 3.00) {
        return 24;
    }
    return 20;
}
