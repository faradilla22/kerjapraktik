<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Pabrik;
use Illuminate\Http\Request;

class KoordinatorController extends Controller
{
    public function index()
    {
        $penggunas = Pengguna::where('approved', false)->get();
        $pabriks = Pabrik::all();
        return view('koordinator.penggunas', compact('penggunas', 'pabriks'));
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

        return redirect()->route('koordinator.penggunas')->with('status', 'Registrasi disetujui.');
    }
}
