<?php
// Inisialisasi variabel hasil
$hpp = null;
$pembelian_bersih = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form dan sanitasi
    $persediaan_awal  = floatval($_POST['persediaan_awal']);
    $pembelian        = floatval($_POST['pembelian']);
    $biaya_angkut     = floatval($_POST['biaya_angkut']);
    $retur_pembelian  = floatval($_POST['retur_pembelian']);
    $potongan_beli    = floatval($_POST['potongan_beli']);
    $persediaan_akhir = floatval($_POST['persediaan_akhir']);

    // Hitung Pembelian Bersih
    // Rumus: Pembelian + Biaya Angkut - Retur Pembelian - Potongan Pembelian
    $pembelian_bersih = ($pembelian + $biaya_angkut) - ($retur_pembelian + $potongan_beli);

    // Hitung Harga Pokok Penjualan (HPP)
    // Rumus: Persediaan Awal + Pembelian Bersih - Persediaan Akhir
    $hpp = ($persediaan_awal + $pembelian_bersih) - $persediaan_akhir;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Harga Pokok Penjualan (HPP)</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Kalkulator Harga Pokok Penjualan (HPP)</h4>
                    </div>
                    <div class="card-body">
                        
                        <!-- Form Input -->
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="persediaan_awal" class="form-label">Persediaan Awal Barang (Rp)</label>
                                <input type="number" step="any" class="form-control" id="persediaan_awal" name="persediaan_awal" value="<?= $_POST['persediaan_awal'] ?? '' ?>" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="pembelian" class="form-label">Pembelian Bersih / Kotor (Rp)</label>
                                    <input type="number" step="any" class="form-control" id="pembelian" name="pembelian" value="<?= $_POST['pembelian'] ?? '' ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="biaya_angkut" class="form-label">Biaya Angkut Pembelian (Rp)</label>
                                    <input type="number" step="any" class="form-control" id="biaya_angkut" name="biaya_angkut" value="<?= $_POST['biaya_angkut'] ?? '0' ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="retur_pembelian" class="form-label">Retur Pembelian (Rp)</label>
                                    <input type="number" step="any" class="form-control" id="retur_pembelian" name="retur_pembelian" value="<?= $_POST['retur_pembelian'] ?? '0' ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="potongan_beli" class="form-label">Potongan Pembelian / Diskon (Rp)</label>
                                    <input type="number" step="any" class="form-control" id="potongan_beli" name="potongan_beli" value="<?= $_POST['potongan_beli'] ?? '0' ?>">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="persediaan_akhir" class="form-label">Persediaan Akhir Barang (Rp)</label>
                                <input type="number" step="any" class="form-control" id="persediaan_akhir" name="persediaan_akhir" value="<?= $_POST['persediaan_akhir'] ?? '' ?>" required>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Hitung HPP</button>
                        </form>

                        <!-- Hasil Perhitungan -->
                        <?php if ($hpp !== null): ?>
                            <hr class="my-4">
                            <div class="alert alert-info">
                                <h5 class="alert-heading font-weight-bold">Hasil Perhitungan:</h5>
                                <p class="mb-1">Pembelian Bersih: <strong>Rp <?= number_format($pembelian_bersih, 0, ',', '.') ?></strong></p>
                                <hr>
                                <h4 class="mb-0 text-success">Total HPP: Rp <?= number_format($hpp, 0, ',', '.') ?></h4>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
