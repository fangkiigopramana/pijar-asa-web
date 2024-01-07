<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'pengajar') {
                return redirect()->route('teacher.dashboard')->with('login-success','Login berhasil!');
            }
            if (Auth::user()->role === 'murid') {
                return redirect()->route('student.dashboard')->with('login-success','Login berhasil!');
            }
        }
        return view('auth.login');
    }

    public function loginStore(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            if(Auth::user()->role === 'pengajar'){
                return redirect()->route('teacher.dashboard')->with('login-success','Login berhasil!');
            }

            if(Auth::user()->role === 'murid'){
                return redirect()->route('student.dashboard')->with('login-success','Login berhasil!');
            }
            return redirect()->route('auth.login');
        }
        return back()->with('login-fail', "Login Gagal!");
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('auth.login');
        }
        return view('auth.register', [
            'nameRoute' => FacadesRequest::route()->getName()
        ]);
    }

    public function registerStore(Request $request)
    {

        if ($request->password !== $request->password_confirm) {
            return redirect()->back()->with('register-fail','Password belum sesuai!');
        }

        // Register Murid
        if ($request->nama_wali) {
            $validator = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email',
                'gender' => 'required|in:L,P',
                'nama_wali' => 'required|max:255',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required|date',
                'nomor_handphone' => 'required|numeric',
                'alamat' => 'required',
                'password' => 'required|min:8'
            ]);
            $validator['role'] = 'murid';
            
            $findUser = User::all()->where('email','=',$request->email);
            if(count($findUser)){
                return redirect()->route('auth.register.student')->with('register-fail','Email telah terdaftar, silahkan gunakan email lain!');
            }

            $user = User::create([
                'name' => $validator['name'],
                'role' => $validator['role'],
                'email' => $validator['email'],
                'gender' => $validator['gender'],
                'nama_wali' => $validator['nama_wali'],
                'tempat_lahir' => $validator['tempat_lahir'],
                'tanggal_lahir' => $validator['tanggal_lahir'],
                'nomor_handphone' => $validator['nomor_handphone'],
                'alamat' => $validator['alamat'],
                'password' => Hash::make($validator['password'])
            ]);

            if (!$user) {
                return redirect()->route('auth.register.student')->with('register-fail','Registrasi Gagal!');
            }

            return redirect()->route('auth.login')->with('register-success','Selamat, registrasi berhasil!');
        }

        // Register Pengajar
        if ($request->mata_pelajaran) {
            $validator = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email',
                'gender' => 'required|in:L,P',
                'mata_pelajaran' => 'required',
                'pendidikan_terakhir' => 'required|in:SD,SMP,SMA/SMK,D3,D4/S1',
                'nomor_handphone' => 'required|numeric',
                'alamat' => 'required',
                'password' => 'required|min:8'
            ]);
            $validator['role'] = 'pengajar';
            
            $findUser = User::all()->where('email','=',$request->email);
            if(count($findUser)){
                return redirect()->route('auth.register.student')->with('register-fail','Email telah terdaftar, silahkan gunakan email lain!');
            }

            $user = User::create([
                'name' => $validator['name'],
                'role' => $validator['role'],
                'email' => $validator['email'],
                'gender' => $validator['gender'],
                'mata_pelajaran' => $validator['mata_pelajaran'],
                'pendidikan_terakhir' => $validator['pendidikan_terakhir'],
                'nomor_handphone' => $validator['nomor_handphone'],
                'alamat' => $validator['alamat'],
                'password' => Hash::make($validator['password'])
            ]);    

            if (!$user) {
                return redirect()->route('auth.register.teacher')->with('register-fail','Registrasi Gagal!');
            }

            return redirect()->route('auth.login')->with('register-success','Selamat, registrasi berhasil!');
        }

    }

    public function logout()
    {
        if (Auth::check()) {   
            Auth::logout();
        }
        return redirect()->route('auth.login');
    }
}
