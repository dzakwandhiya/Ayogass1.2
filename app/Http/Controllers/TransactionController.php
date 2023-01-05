<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::user();
        return view('LoginAdmin.daftarTransaksi', compact('user'));
    }
    public function index2()
    {
        $user = Auth::user();
        return view('LoginAdmin.dasboard-transaksi', compact('user'));
    }
    public function index3()
    {
        $user = Auth::user();
        return view('LoginAdmin.dasboard-produk', compact('user'));
    }
    public function transaction($id)
    {
        if (!Session::get('agen')) {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
        $user = Auth::user();
        $product = Product::findorfail($id);
        return view('LoginUser.pembayaran', compact('user', 'product'));
    }

    public function getAllTransactionsAgen()
    {
        if (!Session::get('agen')) {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
        $user = Auth::user();
        $transactions = DB::table('transactions as t')->select(
            't.id',
            't.deskripsi',
            't.alamatTujuan',
            't.buktiPembayaran',
            't.tanggalTransaksi',
            't.stokPemesanan',
            't.statusPemesanan',
            't.metodePembayaran',
            't.totalPembayaran',
            't.totalPembayaran',
            't.totalPembayaran',
            'p.namaProduk',
        )
            ->join('products as p', 't.product_id', '=', 'p.id')
            ->join('users as u', 'u.id', '=', 't.agen_id')

            ->where('u.id', '=', $user->id)
            // ->groupBy('u.id')
            ->orderBy('t.statusPemesanan')
            ->get();
        return view('LoginUser.daftarPemesanan', compact('transactions', 'user'));
    }
    public function getAllTransactionsSupplier(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            $transactions = DB::table('transactions as t')->select(
                't.id',
                't.deskripsi',
                't.alamatTujuan',
                't.buktiPembayaran',
                't.tanggalTransaksi',
                't.stokPemesanan',
                //'t.statusPemesanan',
                DB::raw('
                    (CASE
                        WHEN t.statusPemesanan=1 THEN "Menunggu Upload Pembayaran"
                        WHEN t.statusPemesanan=2 THEN "Menunggu validasi bukti pembayaran"
                        WHEN t.statusPemesanan=3 THEN "Mempersiapkan pengiriman gas"
                        WHEN t.statusPemesanan=4 THEN "Produk dalam proses pengiriman"
                        WHEN t.statusPemesanan=5 THEN "Pesanan telah diterima"
                        WHEN t.statusPemesanan=6 THEN "Pesanan ini telah selesai"
                        WHEN t.statusPemesanan=0 THEN "Bukti pembayaran tidak valid"
                    END) AS statusPemesanan
                    '),
                't.metodePembayaran',
                't.totalPembayaran',
                't.totalPembayaran',
                't.totalPembayaran',
                'p.namaProduk',
                'ua.fullname'

            )
                ->join('products as p', 't.product_id', '=', 'p.id')
                ->join('users as ua', 'ua.id', '=', 't.agen_id')
                ->join('users as u', 'u.id', '=', 'p.user_id')
                ->where('u.id', '=', $user->id)
                ->orderBy('t.statusPemesanan')
                ->get();
            return DataTables::of($transactions)
                ->addIndexColumn()
                ->addColumn('action', function ($transactions) {
                    $alert = "onclick=\"return confirm('Apakah anda yakin akan menghapus produk?')\"";
                    $actionBtn = '
                    <a href="' . route('updateTransaction', $transactions->id) . '"><button type="submit" data-target="#updateForm"
                    data-toggle="modal" class="btn btn-warning"><i class="fas fa-edit" style="font-size: 15px"></i></button>
                    </a>
                    <a href="' . route('deleteTransactions', $transactions->id) . '"><button type="submit" ' . $alert . ' class="btn btn-danger show_confirm" style="font-size: 13px">
                    <i class="fa fa-trash"></i></button>
                    </a>

                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function getTransactionsPageSupplier()
    {
        // if (!Session::get('supplier')) {
        //     Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
        //     return back();
        // }
        $user = Auth::user();
        return view('LoginUser.daftarPemesanan', compact('user'));
    }
    public function getTransactionData($id)
    {
        if (!Session::get('agen')) {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
        $user = Auth::user();
        $transaction = Transaction::findorfail($id);
        $product = Product::findorfail($transaction->product_id);
        $check = Rating::where('transaction_id', $transaction->id)
            ->exists();
        $getRating = "";
        $getUlasan = "";
        if($check){
            $rating = Rating::where('transaction_id', $transaction->id)->get();
            $getRating = $rating[0]->rating;
            $getUlasan = $rating[0]->ulasan;
        }
        else{
            $getRating = "-";
            $getUlasan = "-";
        }
        // $getUlasan = "";
        // $test = "";
        // if(empty($rating)){
        //     $test = TRUE;
        //     $getRating = "-";
        //     $getUlasan = "-";
        return view('LoginUser.detail_pesanan', compact('transaction', 'user', 'product', 'getRating', 'getUlasan'));
        // }
        // if(!$test){
        //     $getRating = $rating[0]->rating;
        //     $getUlasan = $rating[0]->ulasan;
        //return view('LoginUser.detail_pesanan', compact('transaction', 'user', 'product', 'rating'));
        //}

    }
    public function upload_bukti_pembayaran($id)
    {
        if (!Session::get('agen')) {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
        $user = Auth::user();
        $transaction = Transaction::findorfail($id);
        $product = Product::findorfail($transaction->product_id);
        return view('LoginUser.bukti_pembayaran', compact('transaction', 'user', 'product'));
    }
    public function view_bukti_pembayaran($id)
    {
        if (!Session::get('agen')) {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
        $user = Auth::user();
        $transaction = Transaction::findorfail($id);
        $product = Product::findorfail($transaction->product_id);
        return view('LoginUser.view_bukti_pembayaran', compact('transaction', 'user', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idProduct)
    {
        date_default_timezone_set('Asia/Jakarta');
        $product = Product::findorfail($idProduct);
        $user = Auth::user();
        $Validator = Validator::make( // memberikan syarat data yang akan dimasukkan
            $request->all(),
            [
                'metodePembayaran' => 'required|numeric',
            ],
            [
                //memodifikasi persyaratan registrasi
                'metodePembayaran.required' => 'Metode pembayaran harus diisi',
            ]
        );
        $get = $Validator->errors()->first();
        if ($Validator->fails()) {
            Alert::error('Transaksi Gagal', $get);
            return back();
        }
        if($product->stokProduk < 25){
            Alert::error('Pesanan dibatalkan!!!', 'Stok sudah tidak tersedia');
            return back();
        }
        $transaksiData = [
            'deskripsi' => $request->deskripsi,
            'alamatTujuan' => $user->alamat,
            'buktiPembayaran' => '',
            'tanggalTransaksi' => date('Y-m-d H:i:s'),
            'stokPemesanan' => 25,
            'statusPemesanan' => 1,
            'metodePembayaran' => $request->metodePembayaran,
            'totalPembayaran' => 25 * $product->hargaProduk,
            'agen_id' => $user->id,
            'product_id' => $product->id,
        ];
        $product->fill([
            'stokProduk' => $product->stokProduk - 25,
            'produkTerjual' => $product->produkTerjual + 25
        ]);
        $product->save();

        $newTransaction = Transaction::create(array_merge($transaksiData));
        Alert::success('Transaksi Berhasil Ditambah', 'Segara lakukan pembayaran dan upload struk pembayaran!');
        return redirect()->intended('/getAllTransaction');
    }
    public function uploadBuktiPembayaran(Request $request, $id)
    {
        $upload = Transaction::findorfail($id);
        $Validator = Validator::make( // memberikan syarat data yang akan dimasukkan
            $request->all(),
            [
                'img' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            ],
            [
                //memodifikasi persyaratan registrasi
                'img.required' => 'Bukti pembayaran harus wajib diisi!',
                'img.image' => 'Bukti pembayaran harus berupa foto!',
                'img.max' => 'Bukti pembayaran maksimal 2MB',
            ]
        );
        $imagePath = 'ID_PESANAN_' . $upload->id . '.' . $request->img->extension();
        // dd($imagePath);

        //$path = $request->file('img')->store('public/bukti_pembayaran');
        $get = $Validator->errors()->first();
        if ($Validator->fails()) {
            Alert::error('Upload Gagal!', $get);
            return back();
        } else {
            $path = $request->img->move(public_path('bukti_pembayaran'), $imagePath);
        }
        $update = $upload->fill([
            'buktiPembayaran' => $imagePath,
            'statusPemesanan' => 2,
        ]);
        $update->save();
        Alert::success('Upload Berhasil !', 'Tunggu proses validasi oleh seller!');
        return redirect()->intended('/getAllTransaction');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function editTransactionBySupplier($id)
    {
        $user = Auth::user();
        $transaction = Transaction::findorfail($id);
        $product = Product::findorfail($transaction->product_id);
        $agen = User::findorfail($transaction->agen_id);
        return view('LoginAdmin.dasboard-edit-pesanan', compact('transaction', 'user', 'product', 'agen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function updateBySupplier(Request $request, $id)
    {
        $user = Auth::user();
        $update = Transaction::findorfail($id);

        if ($update->statusPemesanan != 5) {
            $Validator = Validator::make( // memberikan syarat data yang akan dimasukkan
                $request->all(),
                [
                    'statusPemesanan' => 'required|numeric',
                ],
                [
                    //memodifikasi persyaratan registrasi
                    'statusPemesanan.required' => 'Status pembayaran harus dipilih',
                ]
            );
            $get = $Validator->errors()->first();
            if ($Validator->fails()) {
                Alert::error('Transaksi Gagal', $get);
                return back();
            }
            $update->fill([
                'statusPemesanan' => $request->statusPemesanan
            ]);
        } else {
            Alert::warning('Pesanan ini telah selesai !', 'Status pemesanan telah diterima oleh agen gas');
            return back();
        }
        $update->fill([
            'statusPemesanan' => $request->statusPemesanan
        ]);
        $update->save();
        Alert::success('Update Berhasil !', 'Anda berhasil memperbaharui status pemesanan!');
        //return view('LoginAdmin.dasboard-transaksi', compact('user'));
        return redirect()->intended('/test3');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function buktiPembayaranValid($id){
        $transaction = Transaction::findorfail($id);
        $transaction->fill([
            'statusPemesanan' => 3,
        ]);
        $transaction->save();
        Alert::success('Update Berhasil !', 'Anda berhasil memperbaharui status pemesanan!');
        //return view('LoginAdmin.dasboard-transaksi', compact('user'));
        return redirect()->intended('/test3');

    }
    public function buktiPembayaranTidakValid($id){
        $transaction = Transaction::findorfail($id);
        $transaction->fill([
            'statusPemesanan' => 0,
        ]);
        $transaction->save();
        Alert::success('Update Berhasil !', 'Anda berhasil memperbaharui status pemesanan!');
        //return view('LoginAdmin.dasboard-transaksi', compact('user'));
        return redirect()->intended('/test3');

    }
    public function upload_bukti_pembayaran_new($id)
    {
        if (!Session::get('agen')) {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
        $user = Auth::user();
        $transaction = Transaction::findorfail($id);
        $product = Product::findorfail($transaction->product_id);
        return view('LoginUser.bukti_pembayaran_new', compact('transaction', 'user', 'product'));
    }
    public function uploadUlangBuktiPembayaran(Request $request, $id)
    {
        $upload = Transaction::findorfail($id);
        $Validator = Validator::make( // memberikan syarat data yang akan dimasukkan
            $request->all(),
            [
                'img' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            ],
            [
                //memodifikasi persyaratan registrasi
                'img.required' => 'Bukti pembayaran harus wajib diisi!',
                'img.image' => 'Bukti pembayaran harus berupa foto!',
                'img.max' => 'Bukti pembayaran maksimal 2MB',
            ]
        );
        $imagePath = $upload->buktiPembayaran.'_NEW.' . $request->img->extension();
        // dd($imagePath);

        //$path = $request->file('img')->store('public/bukti_pembayaran');
        $get = $Validator->errors()->first();
        if ($Validator->fails()) {
            Alert::error('Upload Gagal!', $get);
            return back();
        } else {
            $path = $request->img->move(public_path('bukti_pembayaran'), $imagePath);
        }
        $update = $upload->fill([
            'buktiPembayaran' => $imagePath,
            'statusPemesanan' => 2,
        ]);
        $update->save();
        Alert::success('Upload Berhasil !', 'Tunggu proses validasi oleh seller!');
        return redirect()->intended('/getAllTransaction');
    }

    public function destroy($id)
    {
        $transaction = Transaction::findorfail($id);
        $transaction->delete();
        Alert::warning('Transaksi Berhasil dihapus!', 'Anda telah menghapus product terpilih');
        return redirect()->intended('/test3');
    }
}
