<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Contact;
use App\Http\Services\ContactService;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;

class ContactTest extends TestCase
{
    use WithFaker;

    /**
     * Teste deve criar um contato para o usuário pela service
     *
     * @return void
     */
    public function testShouldCreateContactByService()
    {
        $service = app(ContactService::class);

        $inputs = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'user_id' => User::factory()->create()->id
        ];

        $serviceResponse = $service->store(
            $inputs['name'],
            $inputs['email'],
            $inputs['phone'],
            $inputs['user_id']
        );

        $this->assertTrue($serviceResponse['success']);
        $this->assertDatabaseHas('contacts', [
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'phone' => $inputs['phone'],
            'user_id' => $inputs['user_id']
        ]);
    }
}
