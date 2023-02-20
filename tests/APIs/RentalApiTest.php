<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Rental;

class RentalApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_rental()
    {
        $rental = Rental::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/rentals', $rental
        );

        $this->assertApiResponse($rental);
    }

    /**
     * @test
     */
    public function test_read_rental()
    {
        $rental = Rental::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/rentals/'.$rental->id
        );

        $this->assertApiResponse($rental->toArray());
    }

    /**
     * @test
     */
    public function test_update_rental()
    {
        $rental = Rental::factory()->create();
        $editedRental = Rental::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/rentals/'.$rental->id,
            $editedRental
        );

        $this->assertApiResponse($editedRental);
    }

    /**
     * @test
     */
    public function test_delete_rental()
    {
        $rental = Rental::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/rentals/'.$rental->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/rentals/'.$rental->id
        );

        $this->response->assertStatus(404);
    }
}
