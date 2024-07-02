<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class UpdateEstimasiBusuk extends Command
{
    // The name and signature of the console command.
    protected $signature = 'products:update-estimasi-busuk';

    // The console command description.
    protected $description = 'Reduce estimasi_busuk value by 1 every day';

    // Create a new command instance.
    public function __construct()
    {
        parent::__construct();
    }

    // Execute the console command.
    public function handle()
    {
        // Fetch products with estimasi_busuk > 0
        $products = Product::where('estimasi_busuk', '>', 0)->get();

        // Loop through each product and reduce estimasi_busuk by 1
        foreach ($products as $product) {
            $product->estimasi_busuk -= 1;
            $product->save();
        }

        $this->info('Estimasi busuk updated successfully!');
    }
}
