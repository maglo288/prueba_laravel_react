<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transfer;
use App\Models\Wallet;

class TransferController extends Controller
{
    //
    public function store(Request $request){
        //$request->wallet_id = 1;
        $wallet = Wallet::findOrFail($request->wallet_id);
        //die(var_dump($wallet->id));
        $wallet->money = $wallet->money + $request->amount;
        $wallet->update();

        $transfer = new Transfer();
        $transfer->description = $request->description;
        $transfer->amount = $request->amount;
        $transfer->wallet_id = $request->wallet_id;
        $transfer->save();
        return response()->json($transfer,201);
    }
}
