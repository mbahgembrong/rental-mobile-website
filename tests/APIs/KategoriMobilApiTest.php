<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\KategoriMobil;

class KategoriMobilApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_kategori_mobil()
    {
        $kategoriMobil = KategoriMobil::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/kategori_mobils', $kategoriMobil
        );

        $this->assertApiResponse($kategoriMobil);
    }

    /**
     * @test
     */
    public function test_read_kategori_mobil()
    {
        $kategoriMobil = KategoriMobil::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/kategori_mobils/'.$kategoriMobil->id
        );

        $this->assertApiResponse($kategoriMobil->toArray());
    }

    /**
     * @test
     */
    public function test_update_kategori_mobil()
    {
        $kategoriMobil = KategoriMobil::factory()->create();
        $editedKategoriMobil = KategoriMobil::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/kategori_mobils/'.$kategoriMobil->id,
            $editedKategoriMobil
        );

        $this->assertApiResponse($editedKategoriMobil);
    }

    /**
     * @test
     */
    public function test_delete_kategori_mobil()
    {
        $kategoriMobil = KategoriMobil::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/kategori_mobils/'.$kategoriMobil->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/kategori_mobils/'.$kategoriMobil->id
        );

        $this->response->assertStatus(404);
    }
}
