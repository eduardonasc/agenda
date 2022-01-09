<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;

class ContactTest extends TestCase
{
    use WithFaker;

    /**
     * Teste deve criar um contato para o usuário
     *
     * @return void
     */
    public function testShouldCreateContact()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $inputs = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'user_id' => $user->id
        ];
        $response = $this->post(route('contacts.store'), $inputs);

        $response->assertStatus(302);

        $this->assertDatabaseHas('contacts', [
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'phone' => $inputs['phone'],
            'user_id' => $user->id
        ]);
    }
}
