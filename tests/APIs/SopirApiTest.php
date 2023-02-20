<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Sopir;

class SopirApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_sopir()
    {
        $sopir = Sopir::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/sopirs', $sopir
        );

        $this->assertApiResponse($sopir);
    }

    /**
     * @test
     */
    public function test_read_sopir()
    {
        $sopir = Sopir::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/sopirs/'.$sopir->id
        );

        $this->assertApiResponse($sopir->toArray());
    }

    /**
     * @test
     */
    public function test_update_sopir()
    {
        $sopir = Sopir::factory()->create();
        $editedSopir = Sopir::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/sopirs/'.$sopir->id,
            $editedSopir
        );

        $this->assertApiResponse($editedSopir);
    }

    /**
     * @test
     */
    public function test_delete_sopir()
    {
        $sopir = Sopir::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/sopirs/'.$sopir->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/sopirs/'.$sopir->id
        );

        $this->response->assertStatus(404);
    }
}
