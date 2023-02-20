<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Mobil;

class MobilApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_mobil()
    {
        $mobil = Mobil::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/mobils', $mobil
        );

        $this->assertApiResponse($mobil);
    }

    /**
     * @test
     */
    public function test_read_mobil()
    {
        $mobil = Mobil::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/mobils/'.$mobil->id
        );

        $this->assertApiResponse($mobil->toArray());
    }

    /**
     * @test
     */
    public function test_update_mobil()
    {
        $mobil = Mobil::factory()->create();
        $editedMobil = Mobil::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/mobils/'.$mobil->id,
            $editedMobil
        );

        $this->assertApiResponse($editedMobil);
    }

    /**
     * @test
     */
    public function test_delete_mobil()
    {
        $mobil = Mobil::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/mobils/'.$mobil->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/mobils/'.$mobil->id
        );

        $this->response->assertStatus(404);
    }
}
