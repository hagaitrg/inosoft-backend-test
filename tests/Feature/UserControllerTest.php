<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class UserControllerTest extends TestCase {
    public function testRegister() {
        $password= $this->faker->password;
        $payload = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $password,
            'confirm_password' => $password,
        ];

        $this->json('post', '/api/v1/users/register', $payload)
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'success',
                    'code',
                    'message',
                    'data' => [
                        '_id',
                        'name',
                        'email',
                        'email_verified_at',
                        'updated_at',
                        'created_at'
                    ]
                ]);
    }
}