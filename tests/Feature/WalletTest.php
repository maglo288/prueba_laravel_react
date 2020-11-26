<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Transfer;
use App\Models\Wallet;
use Tests\TestCase;

class WalletTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetWallet()
    {
        
        $wallet = \App\Models\Wallet::factory(Wallet::class)->create();
        $transfers = \App\Models\Transfer::factory(Transfer::class)->create([
            'wallet_id' => $wallet->id
        ]);
        $response = $this->json('GET','wallet');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id', 'money', 'transfers' => [
                    '*' => [
                        'id','amount','description','wallet_id'
                    ]
                ]
            ]);
        $this->assertCount(3, $response->json()['transfers']);
    }
}
