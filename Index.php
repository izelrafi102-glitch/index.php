<?php
// Inisialisasi variabel awal
$bahan_baku = 0;
$tenaga_kerja = 0;
$overhead = 0;
$jumlah_produksi = 0;
$margin_persen = 0;

$hpp_total = 0;
$hpp_per_unit = 0;
$harga_jual_per_unit = 0;
$keuntungan_per_unit = 0;
$is_calculated = false;

// Memproses input jika form dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bahan_baku = (float)$_POST['bahan_baku'];
    $tenaga_kerja = (float)$_POST['tenaga_kerja'];
    $overhead = (float)$_POST['overhead'];
    $jumlah_produksi = (int)$_POST['jumlah_produksi'];
    $margin_persen = (float)$_POST['margin_persen'];

    if ($jumlah_produksi > 0) {
        // Kalkulasi HPP
        $hpp_total =$bahan_baku + $tenaga_kerja +$overhead;
        $hpp_per_unit = $hpp_total / $jumlah_produksi;
        
        // Kalkulasi Harga Jual berdasarkan Margin Keuntungan
        $keuntungan_per_unit =$hpp_per_unit * ($margin_persen / 100);$harga_jual_per_unit = $hpp_per_unit +$keuntungan_per_unit;
        
        $is_calculated = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator HPP Produk</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f9; }
        .container { max-width: 500px; background: #fff; padding:
