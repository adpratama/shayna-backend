<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CheckoutRequest;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;


class CheckoutController extends Controller
{
    //
    public function checkout(CheckoutRequest $request)
    {
        // membuat variabel data untuk dimasukkan nantinya ke dalam tabel transaksi
        $data = $request->except('transaction_details');
        $data['uuid'] = 'TRX' . mt_rand(10000,99999) . mt_rand(100,999); // identifier transaksi

        $transaction = Transaction::create($data);


        // fungsi pengulangan untuk 
        foreach ($request->transaction_details as $product)
        {
            // query insert ke tabel transaksi
            $details[] = new TransactionDetail([
                'transaction_id' => $transaction->id,
                'product_id' => $product

            ]);
            
            // query mengurangi stok bila dibeli
            Product::find($product)->decrement('quantity');
        }

        //penyimpanan details
        $transaction->details()->saveMany($details);

        return ResponseFormatter::success($transaction);
    }
}
