<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Pabrik;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $penggunas = Pengguna::where('approved', false)->get();
        $pabriks = Pabrik::all();
        return view('admin.penggunas', compact('penggunas', 'pabriks'));
    }

    public function approve(Request $request, Pengguna $pengguna)
    {
        $request->validate([
            'id_pabrik' => 'nullable|exists:pabriks,id',
        ]);

        $idPabrik = $request->id_pabrik ?: null;

        $pengguna->update([
            'id_pabrik' => $idPabrik,
            'approved' => true,
        ]);

        return redirect()->route('admin.penggunas')->with('status', 'Registrasi disetujui.');
    }
}
