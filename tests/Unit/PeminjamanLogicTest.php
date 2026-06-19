<?php

use Carbon\Carbon;

// Kita simulasikan logika Controller sebagai fungsi mandiri untuk diuji secara Unit murni
function isLamaPeminjamanValid($tglPinjam, $tglKembali) {
    $tglPinjam = Carbon::parse($tglPinjam);
    $tglKembali = Carbon::parse($tglKembali);

    if ($tglPinjam->diffInDays($tglKembali) > 30) {
        return false;
    }
    return true;
}

it('mengembalikan true jika selisih tanggal kembali dan pinjam <= 30 hari', function () {
    $pinjam = Carbon::create(2023, 1, 1);
    $kembali = Carbon::create(2023, 1, 31); // Selisih tepat 30 hari

    // Independent path 1: selisih <= 30
    expect(isLamaPeminjamanValid($pinjam, $kembali))->toBeTrue();
});

it('mengembalikan false jika selisih tanggal kembali dan pinjam > 30 hari', function () {
    $pinjam = Carbon::create(2023, 1, 1);
    $kembali = Carbon::create(2023, 2, 1); // Selisih 31 hari

    // Independent path 2: selisih > 30
    expect(isLamaPeminjamanValid($pinjam, $kembali))->toBeFalse();
});
