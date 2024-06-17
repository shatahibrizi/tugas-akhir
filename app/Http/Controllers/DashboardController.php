<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Pembeli;
use App\Models\Pesanan;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user instanceof User) { // Assuming there is a method to check if the user is a pengepul
            $pengepulId = $user->id_pengepul;

            // Get sales data per day for the last 30 days for the pengepul
            $salesData = Pesanan::select(
                DB::raw('DATE(tanggal_pesanan) as date'),
                DB::raw('SUM(total_harga) as total_sales')
            )
                ->where('tanggal_pesanan', '>=', Carbon::now()->subDays(30))
                ->whereHas('products.pengepul', function ($query) use ($pengepulId) {
                    $query->where('users.id_pengepul', $pengepulId);
                })
                ->where('status', 'Selesai')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();

            // Get product entry count per day for the last 30 days for the pengepul
            $productEntryData = DB::table('tambah_produk')
                ->select(
                    DB::raw('DATE(tanggal) as date'),
                    DB::raw('COUNT(*) as total_entries')
                )
                ->where('tanggal', '>=', Carbon::now()->subDays(30))
                ->where('id_pengepul', $pengepulId)
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();

            // Get product count sold per day for the last 30 days for the pengepul
            $orderData = DB::table('item_pesanan')
                ->select(
                    DB::raw('DATE(item_pesanan.created_at) as date'),
                    DB::raw('SUM(item_pesanan.jumlah) as total_sold')
                )
                ->join('pesanan', 'item_pesanan.id_pesanan', '=', 'pesanan.id_pesanan')
                ->join('products', 'item_pesanan.id_produk', '=', 'products.id_produk')
                ->join('tambah_produk', 'products.id_produk', '=', 'tambah_produk.id_produk')
                ->where('item_pesanan.created_at', '>=', Carbon::now()->subDays(30))
                ->where('tambah_produk.id_pengepul', $pengepulId)
                ->where('pesanan.status', 'Selesai')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();

            // Get latest product additions from tambah_produk for the pengepul
            $productEntries = DB::table('tambah_produk')
                ->join('products', 'tambah_produk.id_produk', '=', 'products.id_produk')
                ->join('users', 'tambah_produk.id_pengepul', '=', 'users.id_pengepul')
                ->select('products.nama_produk', 'tambah_produk.jumlah', 'tambah_produk.tanggal', 'users.nama as pengepul_nama')
                ->where('tambah_produk.id_pengepul', $pengepulId)
                ->orderBy('tambah_produk.tanggal', 'desc')
                ->get();

            // Get all orders for the pengepul
            $orders = Pesanan::with(['products', 'pembeli', 'products.pengepul'])
                ->whereHas('products.pengepul', function ($query) use ($pengepulId) {
                    $query->where('users.id_pengepul', $pengepulId);
                })
                ->get();

            // Prepare data for charts
            $salesChartData = [
                'labels' => $salesData->pluck('date')->map(function ($date) {
                    return Carbon::parse($date)->format('d M');
                }),
                'data' => $salesData->pluck('total_sales')
            ];

            $productEntryChartData = [
                'labels' => $productEntryData->pluck('date')->map(function ($date) {
                    return Carbon::parse($date)->format('d M');
                }),
                'data' => $productEntryData->pluck('total_entries')
            ];

            $orderChartData = [
                'labels' => $orderData->pluck('date')->map(function ($date) {
                    return Carbon::parse($date)->format('d M');
                }),
                'data' => $orderData->pluck('total_sold')
            ];

            $totalSales = Pesanan::whereHas('products.pengepul', function ($query) use ($pengepulId) {
                $query->where('users.id_pengepul', $pengepulId);
            })->where('status', 'Selesai')->sum('total_harga');

            $totalProducts = Product::whereHas('pengepul', function ($query) use ($pengepulId) {
                $query->where('tambah_produk.id_pengepul', $pengepulId);
            })->count();

            // Hitung persentase pertumbuhan penjualan, jumlah pelanggan, dan penurunan produk
            $lastMonthSales = Pesanan::whereBetween('tanggal_pesanan', [now()->subMonth(), now()])
                ->whereHas('products.pengepul', function ($query) use ($pengepulId) {
                    $query->where('users.id_pengepul', $pengepulId);
                })
                ->sum('total_harga');
            $previousMonthSales = Pesanan::whereBetween('tanggal_pesanan', [now()->subMonths(2), now()->subMonth()])
                ->whereHas('products.pengepul', function ($query) use ($pengepulId) {
                    $query->where('users.id_pengepul', $pengepulId);
                })
                ->sum('total_harga');
            $salesGrowthPercentage = $previousMonthSales > 0 ? (($lastMonthSales - $previousMonthSales) / $previousMonthSales) * 100 : 0;

            $totalProductQuantity = Product::whereHas('pengepul', function ($query) use ($pengepulId) {
                $query->where('users.id_pengepul', $pengepulId);
            })->sum('jumlah');

            return view('pengepul.dashboard', compact(
                'salesChartData',
                'productEntryChartData',
                'orderChartData',
                'productEntries',
                'totalSales',
                'totalProducts',
                'salesGrowthPercentage',
                'totalProductQuantity',
                'orders'
            ));
        } else {
            // Get sales data per day for the last 30 days
            $salesData = Pesanan::select(
                DB::raw('DATE(tanggal_pesanan) as date'),
                DB::raw('SUM(total_harga) as total_sales')
            )
                ->where('tanggal_pesanan', '>=', Carbon::now()->subDays(30))
                ->where('status', 'Selesai')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();

            // Get product entry count per day for the last 30 days
            $productEntryData = DB::table('tambah_produk')
                ->select(
                    DB::raw('DATE(tanggal) as date'),
                    DB::raw('COUNT(*) as total_entries')
                )
                ->where('tanggal', '>=', Carbon::now()->subDays(30))
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();

            // Get product count sold per day for the last 30 days, filtered by 'Selesai' status
            $orderData = DB::table('item_pesanan')
                ->join('pesanan', 'item_pesanan.id_pesanan', '=', 'pesanan.id_pesanan')
                ->select(
                    DB::raw('DATE(pesanan.tanggal_pesanan) as date'),
                    DB::raw('SUM(item_pesanan.jumlah) as total_sold')
                )
                ->where('pesanan.tanggal_pesanan', '>=', Carbon::now()->subDays(30))
                ->where('pesanan.status', 'Selesai')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();



            // Get latest product additions from tambah_produk
            $productEntries = DB::table('tambah_produk')
                ->join('products', 'tambah_produk.id_produk', '=', 'products.id_produk')
                ->join('users', 'tambah_produk.id_pengepul', '=', 'users.id_pengepul')
                ->select('products.nama_produk', 'tambah_produk.jumlah', 'tambah_produk.tanggal', 'users.nama as pengepul_nama')
                ->orderBy('tambah_produk.tanggal', 'desc')
                ->get();

            // Get all orders
            $orders = Pesanan::with(['products', 'pembeli', 'products.pengepul'])->get();

            // Prepare data for charts
            $salesChartData = [
                'labels' => $salesData->pluck('date')->map(function ($date) {
                    return Carbon::parse($date)->format('d M');
                }),
                'data' => $salesData->pluck('total_sales')
            ];

            $productEntryChartData = [
                'labels' => $productEntryData->pluck('date')->map(function ($date) {
                    return Carbon::parse($date)->format('d M');
                }),
                'data' => $productEntryData->pluck('total_entries')
            ];

            $orderChartData = [
                'labels' => $orderData->pluck('date')->map(function ($date) {
                    return Carbon::parse($date)->format('d M');
                }),
                'data' => $orderData->pluck('total_sold')
            ];

            $totalSales = Pesanan::where('status', 'Selesai')->sum('total_harga');
            $totalCustomers = Pembeli::count();
            $totalProducts = Product::count();

            // Hitung persentase pertumbuhan penjualan, jumlah pelanggan, dan penurunan produk
            $lastMonthSales = Pesanan::whereBetween('tanggal_pesanan', [now()->subMonth(), now()])->sum('total_harga');
            $previousMonthSales = Pesanan::whereBetween('tanggal_pesanan', [now()->subMonths(2), now()->subMonth()])->sum('total_harga');
            $salesGrowthPercentage = $previousMonthSales > 0 ? (($lastMonthSales - $previousMonthSales) / $previousMonthSales) * 100 : 0;

            $lastMonthCustomers = Pembeli::whereBetween('created_at', [now()->subMonth(), now()])->count();
            $previousMonthCustomers = Pembeli::whereBetween('created_at', [now()->subMonths(2), now()->subMonth()])->count();
            $customerGrowthPercentage = $previousMonthCustomers > 0 ? (($lastMonthCustomers - $previousMonthCustomers) / $previousMonthCustomers) * 100 : 0;

            $lastMonthProducts = Product::whereBetween('created_at', [now()->subMonth(), now()])->count();
            $previousMonthProducts = Product::whereBetween('created_at', [now()->subMonths(2), now()->subMonth()])->count();
            $productDecreasePercentage = $previousMonthProducts > 0 ? (($lastMonthProducts - $previousMonthProducts) / $previousMonthProducts) * 100 : 0;

            $totalProductQuantity = Product::sum('jumlah');

            return view('admin.dashboard', compact(
                'salesChartData',
                'productEntryChartData',
                'orderChartData',
                'productEntries',
                'totalSales',
                'totalCustomers',
                'totalProducts',
                'salesGrowthPercentage',
                'customerGrowthPercentage',
                'productDecreasePercentage',
                'totalProductQuantity',
                'orders'
            ));
        }
    }
}
