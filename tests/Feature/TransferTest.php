<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Wallet;
use App\Models\Transfer;
class TransferTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPostTransfer()
    {
        $this->withoutExceptionHandling();
        $wallet = \App\Models\Wallet::factory(Wallet::class)->create();
        
        $transfer = \App\Models\Transfer::factory(Transfer::class)->make();
        $response = $this->json('POST','/api/transfer',[
            'description' => 'This is my awesome reply',
            'amount' => $transfer->amount,
            'wallet_id' => $wallet->id,
        ]);
        //die(var_dump($transfer->wallet_id));
        $response->assertJsonStructure([
            'id',
            'description',
            'amount',
            'wallet_id',
        ])->assertStatus(201);

        $this->assertDatabaseHas('transfers',[
            'description' => 'This is my awesome reply',
            'amount' => $transfer->amount,
            'wallet_id' => $wallet->id,
        ]);

        $this->assertDatabaseHas('wallets',[
            'id' => $wallet->id,
            'money' => $wallet->money + $transfer->amount,
        ]);

        
    }
}
