<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class KendaraanControllerTest extends TestCase {
    public function testStoreMotor()
    {
        $payload = [
            "mesin" => $this->faker->name,
            "tipe_suspensi" => $this->faker->name,
            "tipe_transmisi" => $this->faker->name,
            "tahun_keluaran" => "1995",
            "warna" => $this->faker->safeColorName(),
            "harga" => $this->faker->numberBetween(10000000, 100000000)
        ];

        $user = User::where('email', 'test@email.com')->first();

        $this->actingAs($user, 'api')
        ->withSession(['banned'=>false])
        ->json('post','/api/v1/kendaraans/motors/store', $payload)
        ->assertStatus(200)
        ->assertJsonStructure([
            'success',
            'code',
            'message',
            'data' => [
                [
                    'mesin',
                    'tipe_suspensi',
                    'tipe_transmisi',
                    'updated_at',
                    'created_at',
                    '_id'
                ],
                [
                    'motors_id',
                    'tahun_keluaran',
                    'warna',
                    'harga',
                    'updated_at',
                    'created_at',
                    '_id'
                ]
            ]
        ]);
    }
}