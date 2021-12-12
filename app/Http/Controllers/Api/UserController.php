<?php

namespace App\Http\Controllers\Api;

use App\Costumer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index($id)
    {
        $costumer = Costumer::where('id', $id)->get();
        return response()->json([
            'success' => 1,
            'message' => 'Data sukses',
            'costumer' => $costumer
        ]);
    }

    public function login(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }

        $email = $request->input('email');
        $password = $request->input('password');

        $costumer = Costumer::where('email', $email)->first();

        if (!$costumer) {
            return $this->error('Login gagal');
        }

        $validpassowrd = Hash::check($password, $costumer->password);

        if (!$validpassowrd) {
            return $this->error('Login gagal');
        }

        $costumer->update([
            'fcm' => $request->fcm
        ]);
        return response()->json([
            'success' => 1,
            'data' => $costumer,
            'message' => "Login sukses"
        ]);
    }

    public function register(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|unique:costumers',
            'phone' => 'required|unique:costumers',
            'password' => 'required|min:6'
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }

        $name = $request->input('nama');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $fcm = $request->input('fcm');
        $password = Hash::make($request->input('password'));

        $costumer = Costumer::create([
            'nama' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
            'user_id' => 'USER',
            'fcm' => $fcm
        ]);

        return response()->json([
            'success' => 1,
            'data' => $costumer,
            'message' => "Login sukses"
        ]);
    }

    public function ubahpassword(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'password' => 'required|min:6'
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }

        $password = Hash::make($request->input('password'));

        Costumer::where('id', $id)->update([
            'password' => $password
        ]);

        return response()->json([
            'success' => 1,
            'message' => "Ubah password sukses"
        ]);
    }

    public function ubahprofil(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|unique:costumers',
            'phone' => 'required|unique:costumers'
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }

        $name = $request->input('nama');
        $email = $request->input('email');
        $phone = $request->input('phone');

        Costumer::where('id', $id)->update([
            'nama' => $name,
            'email' => $email,
            'phone' => $phone
        ]);

        return response()->json([
            'success' => 1,
            'message' => "Ubah profile sukses"
        ]);
    }

    public function error($pesan)
    {
        return response()->json([
            'success' => 0,
            'message' => $pesan
        ]);
    }
}
