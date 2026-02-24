<?php
require 'vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Illuminate\Http\Request::create('/user/pesanan', 'POST', [
    'id_konsumen' => 2,
    'tanggal' => '2026-02-24',
    'status' => 'pending',
    'total_biaya' => 50000,
    'id_produk' => 1,
    'jumlah' => 1,
    'harga' => 50000
]);

$validator = Illuminate\Support\Facades\Validator::make($request->all(), [
    'id_konsumen' => 'required|exists:users,id',
    'tanggal' => 'required|date',
    'status' => 'required|in:pending,diproses,dikirim,selesai,dibatalkan',
    'total_biaya' => 'required|numeric',
]);

if ($validator->fails()) {
    print_r($validator->errors()->all());
} else {
    echo "Validation passed!\n";
}
