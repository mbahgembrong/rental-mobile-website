<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\DetailMobil;

class DetailMobilApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_detail_mobil()
    {
        $detailMobil = DetailMobil::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/detail_mobils', $detailMobil
        );

        $this->assertApiResponse($detailMobil);
    }

    /**
     * @test
     */
    public function test_read_detail_mobil()
    {
        $detailMobil = DetailMobil::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/detail_mobils/'.$detailMobil->id
        );

        $this->assertApiResponse($detailMobil->toArray());
    }

    /**
     * @test
     */
    public function test_update_detail_mobil()
    {
        $detailMobil = DetailMobil::factory()->create();
        $editedDetailMobil = DetailMobil::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/detail_mobils/'.$detailMobil->id,
            $editedDetailMobil
        );

        $this->assertApiResponse($editedDetailMobil);
    }

    /**
     * @test
     */
    public function test_delete_detail_mobil()
    {
        $detailMobil = DetailMobil::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/detail_mobils/'.$detailMobil->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/detail_mobils/'.$detailMobil->id
        );

        $this->response->assertStatus(404);
    }
}
