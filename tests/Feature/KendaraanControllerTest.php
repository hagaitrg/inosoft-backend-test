<?php

namespace Tests\Feature;

use App\Models\Kendaraan;
use App\Models\Penjualan;
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

    public function testSellKendaraan()
    {
        $user = User::where('email', 'test@email.com')->first();
        $token = JWTAuth::fromUser($user);

        $kendaraan = Kendaraan::all()->pluck('id');
        $kendaraanId = $this->faker->randomElement($kendaraan);

        $payload = [
            "quantity" => $this->faker->numberBetween(1, 10),
            "total_pembayaran" => $this->faker->numberBetween(17000000, 100000000)
        ];

        $this->withHeader('Authorization', 'Bearer'. $token)
        ->json('post',"/api/v1/kendaraans/sell/{$kendaraanId}",$payload)
        ->assertStatus(200)
        ->assertJsonStructure([
            'success',
            'code',
            'message',
            'data'
        ]);
    }

    public function testLaporanPenjualan()
    {
        $user = User::where('email', 'test@email.com')->first();
        $token = JWTAuth::fromUser($user);

        $penjualan = Penjualan::all()->pluck('kendaraan_id');
        $kendaraanId = $this->faker->randomElement($penjualan);

        $this->withoutExceptionHandling();
        $this->withHeader('Authorization', 'Bearer'. $token)
        ->json('get',"/api/v1/kendaraans/laporan-penjualan/{$kendaraanId}")
        ->assertStatus(200)
        ->assertJsonStructure([
            'success',
            'code',
            'message',
            'data'
        ]);
    }
}