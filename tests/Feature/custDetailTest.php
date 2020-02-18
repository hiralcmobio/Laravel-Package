<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class custDetailTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRoute()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPostCustomer()
    {
        $this->withoutMiddleware();

        //generate fake data
        $attributes = [
            'name' => $this->faker->name,
            'address' => $this->faker->paragraph,
            'mobileno' => $this->faker->numberBetween(1000000000,9999999999),
        ];
        $response = $this->post('/postCustomer',$attributes);

        $response->assertStatus(302);
    }
}
