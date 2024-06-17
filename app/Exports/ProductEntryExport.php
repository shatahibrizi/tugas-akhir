<?php

namespace App\Exports;

use App\Models\TambahProduk;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductEntryExport implements FromQuery, WithHeadings
{
    public function query()
    {
        return DB::table('tambah_produk')
            ->join('products', 'tambah_produk.id_produk', '=', 'products.id_produk')
            ->join('users', 'tambah_produk.id_pengepul', '=', 'users.id_pengepul')
            ->select('products.nama_produk', 'tambah_produk.jumlah', 'tambah_produk.tanggal', 'users.nama as pengepul_nama')
            ->orderBy('tambah_produk.tanggal', 'desc');
    }

    public function headings(): array
    {
        return [
            'Nama Produk',
            'Jumlah',
            'Tanggal',
            'Nama Pengepul'
        ];
    }
}
