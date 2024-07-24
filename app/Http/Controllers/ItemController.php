<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bobot; 
use App\Models\Barang;
use Illuminate\View\View;

class ItemController extends Controller
{

    public function index() : View
    {
        //get all products
        $item = Barang::latest()->paginate(10);
 

        //get all products
        $bobots = Bobot::latest()->paginate(10);

        return view('item.index', compact('item', 'bobots'));        
    }

    public function index_item2(){
         // Mendapatkan bagian berdasarkan id_pabrik dan id_bagian
        /* $bagian = Bagian::where('id_pabrik', $id_pabrik)
         ->where('id', $id_bagian)
         ->firstOrFail();
 */
        $item = Barang::latest()->paginate(10);
       // $item = Item::where('id_bagian', $id_bagian)->get();

        // Mendapatkan nama_pabrik
       // $pabrik = Pabrik::findOrFail($id_pabrik);

        //get all products
        $bobots = Bobot::latest()->paginate(10);
        //$penggunas = Pengguna::latest()->paginate(10);

       //render view with products
      
        //render view with products
       return view('item2.index', compact('item','bobots'));
       // return view('item2.index', compact('item','bobots','pabrik', 'bagian'));

    }

    public function update($id, Request $request)
    {
        \Log::info('Update request received', [
            'id' => $id,
            'ecr' => $request->input('ecr'),
            'rr' => $request->input('rr')
        ]);
    
        try {
            $barang = Barang::findOrFail($id);
    
            // Validasi input
            $validatedData = $request->validate([
                'ecr' => 'required',
                'rr' => 'required',
            ]);
    
            // Update kolom ecr dan rr
            $barang->ecr = $validatedData['ecr'];
            $barang->rr = $validatedData['rr'];
            $barang->save();
    
            return response()->json(['success' => true]);
    
        } catch (\Exception $e) {
            \Log::error('Error updating barang', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }


    // Method to store a new barang
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'item_name' => 'required|string|max:255',
            'item_no' => 'required|string|max:255',
            'item_r' => 'required|numeric',
            'item_s' => 'required|numeric',
            'item_l' => 'required|numeric',
            'item_p' => 'required|numeric',
            'item_e' => 'required|numeric',
            'item_b' => 'required|numeric',
            'item_h' => 'required|numeric',
        ]);

        // Buat dan simpan barang baru
        $barang = Barang::create($validatedData);

        return response()->json(['success' => true, 'barang' => $barang]);
    }
    
}