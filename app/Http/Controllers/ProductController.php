<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rating;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;

use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Session::get('supplier')) {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
        $user = Auth::user();
        return view('LoginAdmin.daftarProduk', compact('user'));

        //return view('LoginAdmin.daftarProduk', compact('user'));
    }

    public function getProducts(Request $request)
    {

        if ($request->ajax()) {
            $user = Auth::user();
            $products = DB::table('products as p')
                ->select(
                    'p.id',
                    'p.namaProduk',
                    DB::raw('
                    (CASE
                        WHEN jenisProduk=1 THEN "Elpiji 3KG"
                        WHEN jenisProduk=2 THEN "Elpiji 12KG"
                        WHEN jenisProduk=3 THEN "Bright Gas 5KG"
                        WHEN jenisProduk=4 THEN "Bright Gas 12KG"
                    END) AS jenisProduk
                    '),
                    'p.stokProduk',
                    'p.hargaProduk',
                    'p.produkTerjual',
                    'p.user_id',
                )
                ->where('user_id', $user->id)->get();
            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('action', function ($products) {
                    $alert = "onclick=\"return confirm('Apakah anda yakin akan menghapus produk?')\"";
                    $actionBtn = '
                    <a href="' . route('editProduct', $products->id) . '"><button type="submit" data-target="#updateForm"
                    data-toggle="modal" class="btn btn-warning"><i class="fas fa-edit" style="font-size: 15px"></i></button>
                    </a>

                    <a href="' . route('deleteProduct', $products->id) . '"><button type="submit"'.$alert.' class="btn btn-danger" style="font-size: 13px">
                    <i class="fa fa-trash"></i></button>
                    </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);

//                 form id="delete" method="GET" action="'.route("deleteProduct", $products->id).'"></form>
//                 <button type="submit" onclick="archiveFunction()" form="delete" class="btn btn-danger" style="font-size: 13px">
//                 <i class="fa fa-trash"></i></button></form>



            // <a href="' . route('deleteProduct', $products->id) . '"><button type="submit" class="btn btn-danger show_confirm" style="font-size: 13px">
            // <i class="fa fa-trash"></i></button>
            // </a>

            // $user = Auth::user();
            // $products = Product::latest()->where('user_id', $user->id)->get();
            // return DataTables::of($products)
            //     ->addIndexColumn()
            //     ->addColumn('action', function ($products) {
            //         $actionBtn = '
            //         <a href="' . route('editProduct', $products->id) . '"><button type="submit" data-target="#updateForm"
            //         data-toggle="modal" class="btn btn-warning w-25"><i class="fas fa-edit" style="font-size: 15px"></i></button>
            //         </a>
            //         <a href="' . route('deleteProduct', $products->id) . '"><button type="submit" class="btn btn-danger w-25 show_confirm" style="font-size: 13px">
            //         <i class="fa fa-trash"></i></button>
            //         </a>

            //         ';
            //         return $actionBtn;
            //     })
            //     ->rawColumns(['action'])
            //     ->make(true);
        }
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


    public function store(Request $request)
    {
        $Validator = Validator::make( // memberikan syarat data yang akan dimasukkan
            $request->all(),
            [
                'namaProduk' => 'required|max:200',
                'jenisProduk' => 'required|numeric',
                'stokProduk' => 'required|numeric|min:50',
                'hargaProduk' => 'required|numeric',
            ],
            [
                //memodifikasi persyaratan registrasi
                'namaProduk.required' => 'Nama Produk Harus Diisi',
                'jenisProduk.required' => 'jenis Product Harus Diisi',
                'stokProduk.required' => 'Stok harus Diisi',
                'stokProduk.min:50' => 'Stok minimal Harus 50',
                'hargaProduk.required' => 'Harga Produk Harus Diisi',
                //'jenisProduk.unique' => 'Jenis Product sudah terdaftar' unique:products,jenisProduk',
            ]
        );
        // menampilkan error jika input tidak sesuai dengan persyaratan diatas pada saat registrasi
        $get = $Validator->errors()->first();
        if ($Validator->fails()) {
            Alert::error('Registrasi Gagal', $get);
            return back();
        }
        $get = Auth::user();
        $produk = [
            'namaProduk' => $request->namaProduk,
            'jenisProduk' => $request->jenisProduk,
            'hargaProduk' => $request->hargaProduk,
            'stokProduk' => $request->stokProduk,
            'produkTerjual' => 0,
            'user_id' => $get->id,
        ];

        $newProduct = Product::create(array_merge($produk));
        Alert::success('Produk Berhasil Ditambah', 'Anda bisa mengubah informasi produk');
        return redirect()->intended('/test4');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    function rupiah($angka)
    {
        $hasil = 'Rp ' . number_format($angka, 2, ",", ".");
        return $hasil;
    }
    // public function show(Product $product)
    // {
    //     $user = Auth::user();
    //     $test = DB::table('products')->where('user_id', $user->id)->get();

    //     return view('LoginAdmin.daftarProduk', compact('test'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Session::get('supplier')) {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
        $user = Auth::user();
        $get = Product::findorfail($id);
        return view('LoginAdmin.dasboard-edit-produk', compact('get', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Validator = Validator::make( // memberikan syarat data yang akan dimasukkan
            $request->all(),
            [
                'namaProduk' => 'required|max:200',
                'jenisProduk' => 'required|numeric',
                //'stokProduk' => 'numeric|min:50',
                'hargaProduk' => 'required|numeric',
            ],
            [
                'namaProduk.required' => 'Nama Produk Harus Diisi',
                'jenisProduk.required' => 'jenis Product Harus Diisi',

                //'stokProduk.min:50' => 'Stok minimal Harus 50',
                'hargaProduk.required' => 'Harga Produk Harus Diisi',
            ]
        );
        // menampilkan error jika input tidak sesuai dengan persyaratan diatas pada saat registrasi
        $get = $Validator->errors()->first();
        if ($Validator->fails()) {
            Alert::error('Update Gagal', $get);
            return back();
        }
        $update = Product::findorfail($id);
        // dd($update);
        $stokTerkini = $update->stokProduk;
        if ($request->stokProduk == 0) {
            $update->fill([
                'namaProduk' => $request->namaProduk,
                'jenisProduk' => $request->jenisProduk,
                'hargaProduk' => $request->hargaProduk,

            ]);
            $update->save();
            Alert::success('Update Berhasil !', 'Informasi Produk anda berhasil diperbaharui');
            return redirect()->intended('/test4');
        }
        $update->fill([
            'namaProduk' => $request->namaProduk,
            'jenisProduk' => $request->jenisProduk,
            'hargaProduk' => $request->hargaProduk,
            'stokProduk' => $request->stokProduk + $stokTerkini,

        ]);
        $update->save();
        Alert::success('Update Berhasil !', 'Informasi Product anda berhasil diperbaharui');
        return redirect()->intended('/test4');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('products')->where('id', $id)->delete();
        Alert::warning('Produk Berhasil dihapus!', 'Anda telah menghapus produk yang dipilih');
        return redirect()->intended('/test4');
    }

    public function allProduk()
    {
        if (!Session::get('agen')) {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
        $user = Auth::user();
        $getAllProducts = DB::table('products as p')->select(
            'p.id',
            'p.namaProduk',
            'p.hargaProduk',
            'p.jenisProduk',
            'p.stokProduk',
            'u.fullname',
            'u.nomorTelepon',
            'p.produkTerjual',
        )
            ->join('users as u', 'p.user_id', '=', 'u.id')
            ->get();
        return view('LoginUser.produk.all', compact('getAllProducts', 'user'));
    }
    public function gas3Kg()
    {
        if (!Session::get('agen')) {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
        $user = Auth::user();
        $getAllProducts = DB::table('products as p')->select(
            'p.id',
            'p.namaProduk',
            'p.hargaProduk',
            'p.jenisProduk',
            'p.stokProduk',
            'u.fullname',
            'u.nomorTelepon',
            'p.produkTerjual',
        )
            ->where('p.jenisProduk', 1)
            ->join('users as u', 'p.user_id', '=', 'u.id')
            ->get();

        return view('LoginUser.produk.elpiji3kg', compact('getAllProducts', 'user'));
    }
    public function gas12Kg()
    {
        if (!Session::get('agen')) {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
        $user = Auth::user();
        $getAllProducts = DB::table('products as p')->select(
            'p.id',
            'p.namaProduk',
            'p.hargaProduk',
            'p.jenisProduk',
            'p.stokProduk',
            'u.fullname',
            'u.nomorTelepon',
            'p.produkTerjual',
        )
            ->where('p.jenisProduk', 2)
            ->join('users as u', 'p.user_id', '=', 'u.id')
            ->get();

        return view('LoginUser.produk.elpiji12kg', compact('getAllProducts', 'user'));
    }
    public function brightGas5Kg()
    {
        if (!Session::get('agen')) {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
        $user = Auth::user();
        $getAllProducts = DB::table('products as p')->select(
            'p.id',
            'p.namaProduk',
            'p.hargaProduk',
            'p.jenisProduk',
            'p.stokProduk',
            'u.fullname',
            'u.nomorTelepon',
            'p.produkTerjual',
        )
            ->where('p.jenisProduk', 3)
            ->join('users as u', 'p.user_id', '=', 'u.id')
            ->get();

        return view('LoginUser.produk.brightGas5Kg', compact('getAllProducts', 'user'));
    }
    public function brightGas12Kg()
    {
        if (!Session::get('agen')) {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
        $user = Auth::user();
        $getAllProducts = DB::table('products as p')->select(
            'p.id',
            'p.namaProduk',
            'p.hargaProduk',
            'p.jenisProduk',
            'p.stokProduk',
            'u.fullname',
            'u.nomorTelepon',
            'p.produkTerjual',
        )
            ->where('p.jenisProduk', 4)
            ->join('users as u', 'p.user_id', '=', 'u.id')
            ->get();

        return view('LoginUser.produk.brightGas12Kg', compact('getAllProducts', 'user'));
    }
}
