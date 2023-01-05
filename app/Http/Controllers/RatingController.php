<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

    }
    public function orderRating($id)
    {
        $user = Auth::user();
        $transaction = Transaction::findorfail($id);
        $product = Product::findorfail($transaction->product_id);
        $supplier = User::findorfail($product->user_id);
        return view('LoginUser.rating', compact('transaction', 'user', 'product', 'supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $transaction = Transaction::findorfail($id);
        $product = Product::findorfail($transaction->product_id);
        $agen = User::findorfail($transaction->agen_id);
        $Validator = Validator::make( // memberikan syarat data yang akan dimasukkan
            $request->all(),
            [
                'rating' => 'required',
                'ulasan' => 'required',
            ],
            [
                //memodifikasi persyaratan registrasi
                'rating.required' => 'Rating harus diisi',
                'ulasan.required' => 'Rating harus diisi',

            ]
        );
        $get = $Validator->errors()->first();
        if ($Validator->fails()) {
            Alert::error('Gagal beri ulasan!', $get);
            return back();
        }
        $rating = Rating::create([
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
            'tanggal' => date('Y-m-d H:i:s'),
            'agen_id' => $agen->id,
            'transaction_id' => $transaction->id,
            'product_id' => $product->id,
        ]);
        $transaction->fill([
            'statusPemesanan' => 6,
        ]);
        $rating->save();
        $transaction->save();
        Alert::success('Anda telah memberikan ulasan!', 'Terimakasih '.$agen->fullname.' telah memberikan rating!');
        return redirect()->intended('/getAllTransaction');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
