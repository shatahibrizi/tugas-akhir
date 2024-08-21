<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductEntryExport implements FromQuery, WithHeadings
{
    protected $pengepulId;

    public function __construct($pengepulId = null)
    {
        $this->pengepulId = $pengepulId;
    }

    public function query()
    {
        $query = DB::table('tambah_produk')
            ->join('products', 'tambah_produk.id_produk', '=', 'products.id_produk')
            ->join('users', 'tambah_produk.id_pengepul', '=', 'users.id_pengepul')
            ->select('products.nama_produk', 'tambah_produk.jumlah', 'tambah_produk.tanggal', 'users.nama as pengepul_nama')
            ->orderBy('tambah_produk.tanggal', 'desc');

        if ($this->pengepulId) {
            $query->where('tambah_produk.id_pengepul', $this->pengepulId);
        }

        return $query;
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
