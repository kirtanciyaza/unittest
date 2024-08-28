<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class QrCodeControllerTest extends TestCase
{


    protected $token;

    protected function setUp(): void
    {
        parent::setUp();
        $user = \App\Models\User::factory()->create();
        $this->token = $user->createToken('TestToken')->accessToken;
    }


    public function it_can_fetch_all_products()
    {
        Product::factory()->count(3)->create();

        $response = $this->withToken($this->token)->getJson('/api/product');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                 ])
                 ->assertJsonStructure([
                     'status',
                     'product' => [
                         '*' => [
                             'id',
                             'name',
                             'desc',
                             'price',
                             'image',
                             'created_at',
                             'updated_at',
                         ]
                     ]
                 ]);
    }

    public function it_can_update_a_product()
    {

        $product = Product::factory()->create();


        $file = UploadedFile::fake()->image('test-image.jpeg');

         $response = $this->withToken($this->token)->postJson('/api/product/' . $product->id . '/update', [
            'name' => 'Updated Product',
            'desc' => 'Updated description',
            'price' => 129.99,
            'image' => $file,
        ]);


        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'message' => 'Data updated successfully',
                 ]);
    }


    public function it_can_delete_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->withToken($this->token)->deleteJson('/api/product/' . $product->id . '/delete');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'message' => 'Data deleted successfully',
                 ]);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }


    public function it_throws_validation_error_on_invalid_store_request()
    {
        $response = $this->withToken($this->token)->postJson('/api/product/store', []);

        $response->assertStatus(422)
                 ->assertJsonStructure([
                     'errors' => [
                         'name',
                         'desc',
                         'price',
                     ]
                 ]);
    }
}
