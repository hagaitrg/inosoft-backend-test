<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

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
        $token = JWTAuth::fromUser($user);
        
        $this->withHeader('Authorization', 'Bearer'. $token)
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
                    'motor_id',
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

    public function testStoreMobil()
    {
        $payload = [
            "mesin" => $this->faker->name,
            "kapasitas_penumpang" => $this->faker->numberBetween(0, 8),
            "tipe" => $this->faker->name,
            "tahun_keluaran" => "1995",
            "warna" => $this->faker->safeColorName(),
            "harga" => $this->faker->numberBetween(10000000, 100000000)
        ];

        $user = User::where('email', 'test@email.com')->first();
        $token = JWTAuth::fromUser($user);

        $this->withHeader('Authorization', 'Bearer'. $token)
            ->json('post','/api/v1/kendaraans/mobils/store',$payload)
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'success',
                    'code',
                    'message',
                    'data' => [
                        [
                            'mesin',
                            'kapasitas_penumpang',
                            'tipe',
                            'updated_at',
                            'created_at',
                            '_id'
                        ],
                        [
                            'mobil_id',
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

    public function testStockKendaraan()
    {
        $user = User::where('email', 'test@email.com')->first();
        $token = JWTAuth::fromUser($user);

        $this->withHeader('Authorization', 'Bearer'. $token)
        ->json('get', '/api/v1/kendaraans/stock')
        ->assertStatus(200)
        ->assertJsonStructure([
            'success',
            'code',
            'message',
            'data' => [
                'stock kendaraan',
                'motor',
                'mobils'
            ]
        ]);
    }
}