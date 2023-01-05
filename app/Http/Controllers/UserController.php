<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Session::get('agen')) {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
        $user = Auth::user(); //mengambil data user dari login/register
        return view('LoginUser.home', compact('user'));
    }

    public function toAccount()
    {
        if (!Session::get('agen')) {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
        $user = Auth::user(); //mengambil data user dari login/register
        return view('LoginUser.akun', compact('user'));



        //return view('LoginUser.akun', compact('user'));
    }
    public function toAccountSupplier()
    {
        if (!Session::get('supplier')) {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
        $user = Auth::user(); //mengambil data user dari login/register
        return view('LoginAdmin.dasboard-profil', compact('user'));
    }

    public function relog()
    {
        if (Session::get('agen')) {
            $user = Auth::user();
            Alert::error('Anda telah login!', 'harap logout jika ingin login kembali');
            return view('LoginUser.home', compact('user'));
        }
        if (Session::get('supplier')) {
            $user = Auth::user();
            Alert::error('Anda telah login!', 'harap logout jika ingin login kembali');
            return view('LoginAdmin.daftarProduk', compact('user'));
        }
        return view('login');
    }
    public function about()
    {
        if (!Session::get('agen')) {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
        $user = Auth::user(); //mengambil data user dari login/register
        if ($user->status == 2) {
            $penjual = User::where('status', 1)->get();
            $jumlahPenjual = $penjual->count();
            $agen = User::where('status', 2)->get();
            $jumlahAgen = $agen->count();
            $produk = Product::select('*')->get();
            $jumlahProduk = $produk->count();
            //$agen = User::where('status', 2)->count()->get();
            return view('LoginUser.about', compact('user', 'jumlahPenjual', 'jumlahAgen', 'jumlahProduk'));
        } else {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
    }
    public function contact()
    {
        if (!Session::get('agen')) {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
        $user = Auth::user(); //mengambil data user dari login/register
        if ($user->status == 2) {
            return view('LoginUser.contact', compact('user'));
        } else {
            Alert::error('Ops, anda salah akses!', 'Anda tidak memiliki akses ke halaman ini');
            return back();
        }
    }




    public function login(Request $request)
    {
        $request->validate([ // memberikan syarat data yang akan dimasukkan
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password'); //membuat data inputan kedalam satu variable
        if (Auth::attempt($credentials)) { //mengecek data inputan pada database menggunakan Auth
            $request->session()->regenerate(); //jika data inputam login terbaca maka akan dibuat session
            $user = Auth::user(); //method untuk menggambil data user yang telah login
            if ($user->status == 2) {
                Session::put('agen', TRUE);
                Alert::success('Selamat datang kembali '
                    . strtok(strtoupper($user->fullname), " "), 'Ayo mulai Belanja.');
                return redirect()->intended('/home');
            }
            if ($user->status == 1) {
                Session::put('supplier', TRUE);
                Alert::success('Selamat datang kembali '
                    . strtok(($user->fullname), " "), 'Ayo lihat semua toko mu!');
                return redirect()->intended('/test3');
            }
        }
        //menampilkan error jika email atau password (input) tidak terdaftar atau tidak sesuai
        Alert::error('Email atau Password salah', 'Pastikan email dan password yang anda masukkan benar');
        return back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $Validator = Validator::make( // memberikan syarat data yang akan dimasukkan
            $request->all(),
            [
                'fullname' => 'required|max:200',
                'email' => 'required|email|unique:users,email',
                'alamat' => 'required|max:255',
                'nomorTelepon' => 'required|numeric',
                'gender' => 'required|numeric',
                'status' => 'required|numeric',
                'password' => 'required|confirmed|min:8',
            ],
            [
                //memodifikasi persyaratan registrasi
                'fullname.required' => 'Nama Lengkap Harus Diisi',
                'email.required' => 'Email Harus Diisi',
                'alamat.required' => 'Alamat harus Diisi',
                'nomorTelepon.required' => 'Nomor Telepon Harus Diisi',
                'gender.required' => 'Gender Harus Dipilih',
                'status.required' => 'Tipe user harus dipilih',
                'password.required' => 'Password Harus Dipilih',
                'password.confirmed' => 'Konfirmasi Password Salah',
                'email.unique' => 'Email sudah terdaftar',
            ]
        );
        // menampilkan error jika input tidak sesuai dengan persyaratan diatas pada saat registrasi
        $get = $Validator->errors()->first();
        if ($Validator->fails()) {
            Alert::error('Registrasi Gagal', $get);
            return back();
        }

        // memasukkan input data registrasi yang sudah sesuai kedalam persyaratan registrasi
        // kedalam sebuah variable
        $userData = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'nomorTelepon' => $request->nomorTelepon,
            'gender' => $request->gender,
            'status' => $request->status,
            'password' => Hash::make($request->password),
        ];

        //memasukkan data yang sudah valid kedalam database
        $newUsers = User::create(array_merge($userData));

        //pengecekan user status, sama seperti login
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->status == 2) {
                Session::put('agen', TRUE);
                Alert::success('Selamat datang '
                    . strtok($user->fullname, " ").' !', 'Ayo mulai Belanja.');
                return redirect()->intended('/home');
            }
            if ($user->status == 1) {
                Session::put('supplier', TRUE);
                return redirect()->intended('/test3');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $userId = Auth::id(); //select id dari Auth atau User yang telah login
        $user = User::findOrFail($userId); //mencari user berdasarkan id
        $Validator = Validator::make( //membuat validator form update
            $request->all(),
            [
                'fullname' => 'required|max:200',
                'email' => 'required|email|' . Rule::unique('users')->ignore($user->id),
                'alamat' => 'required|max:255',
                'nomorTelepon' => 'required|numeric',
                'gender' => 'required|numeric',
            ],
            [
                'fullname.required' => 'Nama Lengkap Harus Diisi',
                'email.required' => 'Email Harus Diisi',
                'alamat.required' => 'Alamat harus Diisi',
                'nomorTelepon.required' => 'Nomor Telepon Harus Diisi',
                'gender.required' => 'Gender Harus Dipilih',
                'email.unique' => 'Email sudah terdaftar',
            ]
        );
        $get = $Validator->errors()->first(); //mengambil error input dari validator
        if ($Validator->fails()) {
            Alert::error('Update Gagal', $get);
            return back();
        }

        //mengubah data user auth
        $user->fill([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'nomorTelepon' => $request->nomorTelepon,
            'gender' => $request->gender,
            'status' => '2',
        ]);
        $user->save(); //menyimpan data user baru
        Alert::success('Update Berhasil !', 'Informasi Profil anda berhasil diperbaharui');
        return redirect()->intended('/akun');
    }
    //--update-akun-supplier
    public function updateSupplier(Request $request)
    {
        $userId = Auth::id(); //select id dari Auth atau User yang telah login
        $user = User::findOrFail($userId); //mencari user berdasarkan id
        $Validator = Validator::make( //membuat validator form update
            $request->all(),
            [
                'fullname' => 'required|max:200',
                'email' => 'required|email|' . Rule::unique('users')->ignore($user->id),
                'alamat' => 'required|max:255',
                'nomorTelepon' => 'required|numeric',
                'gender' => 'required|numeric',
            ],
            [
                'fullname.required' => 'Nama Lengkap Harus Diisi',
                'email.required' => 'Email Harus Diisi',
                'alamat.required' => 'Alamat harus Diisi',
                'nomorTelepon.required' => 'Nomor Telepon Harus Diisi',
                'gender.required' => 'Gender Harus Dipilih',
                'email.unique' => 'Email sudah terdaftar',
            ]
        );
        $get = $Validator->errors()->first(); //mengambil error input dari validator
        if ($Validator->fails()) {
            Alert::error('Update Gagal', $get);
            return back();
        }

        //mengubah data user auth
        $user->fill([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'nomorTelepon' => $request->nomorTelepon,
            'gender' => $request->gender,
            'status' => '1',
        ]);
        $user->save(); //menyimpan data user baru
        Alert::success('Update Berhasil !', 'Informasi Profil anda berhasil diperbaharui');
        return redirect()->intended('/akunSupplier');
    }

    public function changePassword(Request $request)
    {
        $Validator = Validator::make(
            $request->all(),
            [
                'current_password' => 'required',
                'password' => 'required|confirmed|min:8',
            ],
            [
                'current_password.required' => 'Password lama tidak valid',
                'password.required' => 'Password Baru Harus Diisi',
                'password.confirmed' => 'Konfirmasi Password Baru Salah',
                'password.min' => 'Password minimal terdiri dari 8 Karakter',
            ]
        );
        $getUser = Auth::user();
        if (!Hash::check($request->get('current_password'), $getUser->password)) {
            $get = $Validator->errors()->first(); //mengambil error input dari validator
            if ($Validator->fails()) {
                Alert::error('Update Gagal', $get);
                return back();
            }
        }
        $get = $Validator->errors()->first(); //mengambil error input dari validator
        if ($Validator->fails()) {
            Alert::error('Update Gagal', $get);
            return back();
        }
        $user =  User::find($getUser->id);
        $user->password =  Hash::make($request->password);
        $user->save();
        Alert::success('Password Berhasil Diubah!', 'Password anda berhasil diubah');
        return redirect()->intended('/akun');
    }
    public function changePasswordSupplier(Request $request)
    {
        $Validator = Validator::make(
            $request->all(),
            [
                'current_password' => 'required',
                'password' => 'required|confirmed|min:8',
            ],
            [
                'current_password.required' => 'Password lama tidak valid',
                'password.required' => 'Password Baru Harus Diisi',
                'password.confirmed' => 'Konfirmasi Password Baru Salah',
                'password.min' => 'Password minimal terdiri dari 8 Karakter',
            ]
        );
        $getUser = Auth::user();
        if (!Hash::check($request->get('current_password'), $getUser->password)) {
            $get = $Validator->errors()->first(); //mengambil error input dari validator
            if ($Validator->fails()) {
                Alert::error('Update Gagal', $get);
                return back();
            }
        }
        $get = $Validator->errors()->first(); //mengambil error input dari validator
        if ($Validator->fails()) {
            Alert::error('Update Gagal', $get);
            return back();
        }
        $user =  User::find($getUser->id);
        $user->password =  Hash::make($request->password);
        $user->save();
        Alert::success('Password Berhasil Diubah!', 'Password anda berhasil diubah');
        return redirect()->intended('/akunSupplier');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
