<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bobot; 
use App\Models\Barang;

class newController extends Controller
{
    public function index_item(){
        $item = Barang::latest()->paginate(10);
 
        //get all products
        $bobots = Bobot::latest()->paginate(10);
        //$penggunas = Pengguna::latest()->paginate(10);

       //render view with products
      
        //render view with products
        return view('item.index', compact('item','bobots'));
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
      /*  $a = 1;
       $b = 1; */
      
      //$a = $request->input('a', 1); // Default value jika tidak ada input
      //$b = $request->input('b', 1); // Default value jika tidak ada input
   
       // Lakukan sesuatu dengan nilai $a dan $b, seperti menyimpannya dalam session atau mengolah data
       // Misalnya, menyimpan dalam session:
     // session(['a' => $a, 'b' => $b]);

        //render view with products
       return view('item2.index', compact('item','bobots'));
       // return view('item2.index', compact('item','bobots','pabrik', 'bagian'));

    }

    public function updateValues(Request $request)
    {
    $a = $request->input('a', 1); // Default value jika tidak ada input
    $b = $request->input('b', 1); // Default value jika tidak ada input

    // Lakukan sesuatu dengan nilai $a dan $b, seperti menyimpannya dalam session atau mengolah data
    // Misalnya, menyimpan dalam session:
    session(['a' => $a, 'b' => $b]);

    // Arahkan kembali ke halaman yang sesuai atau view dengan data baru
    return redirect()->route('item2.index'); // Ganti 'your-route-name' dengan nama rute yang sesuai
}

    
public function updateValues3(Request $request)
    {
    $a = $request->input('a', 1); // Default value jika tidak ada input
    $b = $request->input('b', 1); // Default value jika tidak ada input

    // Lakukan sesuatu dengan nilai $a dan $b, seperti menyimpannya dalam session atau mengolah data
    // Misalnya, menyimpan dalam session:
    session(['a' => $a, 'b' => $b]);

    // Arahkan kembali ke halaman yang sesuai atau view dengan data baru
    return redirect()->route('item.index'); // Ganti 'your-route-name' dengan nama rute yang sesuai
}

public function updateValues4(Request $request)
    {
    $a = $request->input('a', 1); // Default value jika tidak ada input
    $b = $request->input('b', 1); // Default value jika tidak ada input

    // Lakukan sesuatu dengan nilai $a dan $b, seperti menyimpannya dalam session atau mengolah data
    // Misalnya, menyimpan dalam session:
    session(['a' => $a, 'b' => $b]);

    // Arahkan kembali ke halaman yang sesuai atau view dengan data baru
    return redirect()->route('item.index'); // Ganti 'your-route-name' dengan nama rute yang sesuai
}


    // Method to store a new barang
   /*  public function store(Request $request)
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

    // Ambil nilai $a dan $b dari session
    $a = session('a', 1);
    $b = session('b', 1);

    // Ambil nilai bobot dari database
    $bobots = Bobot::all();
    $bobotArray = $bobots->pluck('nilai_bobot')->toArray();

    // Hitung ECR
    $itemData = [
        'ecr' => ($validatedData['item_s'] * $bobotArray[0]) +
                ($validatedData['item_l'] * $bobotArray[1]) +
                ($validatedData['item_p'] * $bobotArray[2]) +
                ($validatedData['item_e'] * $bobotArray[3]) +
                ($validatedData['item_b'] * $bobotArray[4]) +
                ($validatedData['item_h'] * $bobotArray[5]),
        'rr' => 0, // Default value, you might want to calculate this if necessary
    ];

    // Simpan barang baru dengan ECR dan RR
    $barang = Barang::create(array_merge($validatedData, $itemData));

    return response()->json(['success' => true, 'barang' => $barang]);
} */

    public function showItems($id_pabrik, $id_bagian)
    {
        // Mendapatkan bagian berdasarkan id_pabrik dan id_bagian
        $bagian = Bagian::where('id_pabrik', $id_pabrik)
                        ->where('id', $id_bagian)
                        ->firstOrFail();
        
        // Mendapatkan item berdasarkan id_bagian
        $items = Item::where('id_bagian', $id_bagian)->get();
        $bobots = Bobot::latest()->paginate(10);

        // Mendapatkan nama_pabrik
        $pabrik = Pabrik::findOrFail($id_pabrik);

        return view('item2.index', compact('items','bobots', 'bagian', 'pabrik'));
    }

    public function index_summary(){
        $item = Barang::latest()->paginate(10);
        
         
        $bobots = Bobot::latest()->paginate(10);
        
         //render view with products
        return view('summary.index', compact('item','bobots'));
    }
    

    public function updateValues2(Request $request)
    {
    $c = $request->input('c', 1); // Default value jika tidak ada input
    $d = $request->input('d', 1); // Default value jika tidak ada input

    // Lakukan sesuatu dengan nilai $a dan $b, seperti menyimpannya dalam session atau mengolah data
    // Misalnya, menyimpan dalam session:
    session(['c' => $c, 'd' => $d]);

    // Arahkan kembali ke halaman yang sesuai atau view dengan data baru
    return redirect()->route('summary.index'); // Ganti 'your-route-name' dengan nama rute yang sesuai
}



    // Menampilkan form edit atau memproses permintaan update
    public function update2(Request $request, $id)
    {
        // Validasi input data jika perlu
        $validated = $request->validate([
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

        // Cari item berdasarkan ID
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        // Update data item
        $item->update([
            'item_name' => $validated['item_name'],
            'item_no' => $validated['item_no'],
            'R' => $validated['item_r'],
            'S' => $validated['item_s'],
            'L' => $validated['item_l'],
            'P' => $validated['item_p'],
            'E' => $validated['item_e'],
            'B' => $validated['item_b'],
            'H' => $validated['item_h'],
        ]);

        return response()->json(['message' => 'Item updated successfully']);
    }
    
    /* public function destroy($id)
{
    $item = Barang::find($id);
    if ($item) {
        $item->delete();
        return redirect()->route('item2.index')->with('success', 'Item deleted successfully');
    }
    return redirect()->route('item2.index')->with('error', 'Item not found');
} */

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

public function changeStatus($id)
{
    $item = Barang::findOrFail($id);
    $item->status = 'Deleted Need Review'; // Ubah status sesuai kebutuhan Anda
    $item->save();

    return redirect()->back()->with('success', 'Menunggu Aproval Koordinator.');
}
}
