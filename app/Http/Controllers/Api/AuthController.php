<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function me() {
        return [
            // return data perusahaan 
            'nama_perusahaan' => 'Pecellele',
            'alamat' => 'Jl. Merdeka No. 123, Jakarta',
            'telepon' => '+62 21 12345678',
            'email' => 'info@pecellele.com',
            'website' => 'https://www.pecellele.com',
            'deskripsi' => 'Pecellele adalah perusahaan yang bergerak di bidang kuliner dengan spesialisasi dalam hidangan tradisional Indonesia.',
            'tahun_berdiri' => 2005,
            'jumlah_karyawan' => 150,
            'visi' => 'Menjadi perusahaan kuliner terkemuka di Indonesia dengan menyajikan hidangan berkualitas tinggi dan pelayanan terbaik.',
            'misi' => 'Menyediakan hidangan yang lezat dan sehat dengan bahan-bahan terbaik, serta menjaga kepuasan pelanggan melalui pelayanan yang ramah dan profesional.'
        ];
    }

  // R E G I S T E R
  public function register(Request $request) {
    $fields = $request->validate([
        'name' => 'required|string',
        'email' => 'required|string|unique:users,email',
        'password' => 'required|string|confirmed'
    ]);
    $user = User::create([
        'name' => $fields['name'],
        'email' => $fields['email'],
        'password' => bcrypt($fields['password'])
    ]);
    $token = $user->createToken('myapptoken')->plainTextToken;
    $response = [
        'user' => $user,
        'token' => $token
    ];
    return response($response, 201);
  }

  // L O G I N
  public function login(Request $request) {
      $fields = $request->validate([
          'email' => 'required|string',
          'password' => 'required|string'
      ]);
      $user = User::where('email', $fields['email'])->first();
      if(!$user || !Hash::check($fields['password'], $user->password)) {
          return response([
              'message' => 'Bad creds'
          ], 401);
      }
      $token = $user->createToken('myapptoken')->plainTextToken;
      $response = [
          'user' => $user,
          'token' => $token
      ];
      return response($response, 201);
  }

  // L O G O U T
  public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}
