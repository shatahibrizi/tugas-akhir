<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Kategori;
use App\Models\Petani;

class ProductPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_product_page()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create sample data
        $kategori = Kategori::factory()->create(['nama' => 'Sayuran']);
        $petani = Petani::factory()->create(['nama' => 'Pak Budi']);
        Product::factory()->count(3)->create([
            'kategori_id' => $kategori->id_kategori,
            'petani_id' => $petani->id_petani,
        ]);

        // Visit the product page
        $response = $this->get('/stok/products');

        // Assert that the page loads successfully
        $response->assertStatus(200);
        $response->assertSee('Tabel Produk');
    }
}
