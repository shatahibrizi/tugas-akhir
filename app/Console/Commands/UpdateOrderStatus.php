<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pesanan;
use Carbon\Carbon;

class UpdateOrderStatus extends Command
{
    protected $signature = 'orders:update-status';
    protected $description = 'Update order status to Selesai if not confirmed within 5 days';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $fiveDaysAgo = Carbon::now()->subDays(5);

        $orders = Pesanan::where('status', 'Diproses')
            ->where('tanggal_diproses', '<=', $fiveDaysAgo)
            ->get();

        foreach ($orders as $order) {
            $order->status = 'Selesai';
            $order->save();
        }

        $this->info('Order statuses updated successfully!');
    }
}
