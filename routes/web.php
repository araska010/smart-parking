<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/', '/admin/login');
});

Route::get('/struk/{transaksi}', function ($transaksi) {
    return view('struk', [
        'transaksi' => \App\Models\Transaksi::findOrFail($transaksi)
    ]);
});

