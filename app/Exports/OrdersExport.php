<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $id_pengepul;

    public function __construct($id_pengepul)
    {
        $this->id_pengepul = $id_pengepul;
    }

    public function collection()
    {
        // Mengambil data dari tabel item_pesanan untuk pengepul ini
        $orders = DB::table('pesanan')
            ->join('item_pesanan', 'pesanan.id_pesanan', '=', 'item_pesanan.id_pesanan')
            ->join('products', 'item_pesanan.id_produk', '=', 'products.id_produk')
            ->join('tambah_produk', function ($join) {
                $join->on('products.id_produk', '=', 'tambah_produk.id_produk')
                    ->where('tambah_produk.id_pengepul', '=', $this->id_pengepul);
            })
            ->join('pembeli', 'pesanan.id_pembeli', '=', 'pembeli.id_pembeli')
            ->select(
                'pesanan.id_pesanan',
                'pesanan.total_harga',
                'pesanan.status',
                'pesanan.tanggal_pesanan',
                'products.nama_produk',
                'item_pesanan.jumlah',
                'pembeli.nama as nama_pembeli',
                'pembeli.alamat as alamat_pembeli'
            )
            ->get()
            ->groupBy('id_pesanan');

        return $orders;
    }

    public function headings(): array
    {
        return [
            'ID Pesanan',
            'Nama Produk',
            'Jumlah',
            'Total Harga',
            'Status',
            'Tanggal Pesanan',
            'Nama Pembeli',
            'Alamat Pembeli',
        ];
    }

    public function map($order): array
    {
        $firstOrder = $order->first();
        $products = $order->pluck('nama_produk')->toArray();
        $quantities = $order->pluck('jumlah')->toArray();

        return [
            $firstOrder->id_pesanan,
            implode(', ', $products),
            implode(', ', $quantities),
            $firstOrder->total_harga,
            $firstOrder->status,
            $firstOrder->tanggal_pesanan,
            $firstOrder->nama_pembeli,
            $firstOrder->alamat_pembeli,
        ];
    }
}
