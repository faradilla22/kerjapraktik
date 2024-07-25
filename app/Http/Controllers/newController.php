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

/* public function update($id, Request $request)
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
} */


public function update($id, Request $request)
{
    \Log::info('Update request received', [
        'id' => $id,
        'item_name' => $request->input('item_name'),
        'item_no' => $request->input('item_no'),
        'R' => $request->input('item_r'),
        'S' => $request->input('item_s'),
        'L' => $request->input('item_l'),
        'P' => $request->input('item_p'),
        'E' => $request->input('item_e'),
        'B' => $request->input('item_b'),
        'H' => $request->input('item_h')
    ]);

    try {
        $barang = Barang::findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'item_name' => 'required|string|max:255',
            'item_no' => 'required|string|max:255|unique:barangs,item_no',
            'item_r' => 'required|numeric',
            'item_s' => 'required|numeric',
            'item_l' => 'required|numeric',
            'item_p' => 'required|numeric',
            'item_e' => 'required|numeric',
            'item_b' => 'required|numeric',
            'item_h' => 'required|numeric'
        ] , [
            'item_no.unique' => 'Item No sudah ada. Silakan gunakan nomor yang berbeda.',

        ]
    
    );

        // Hitung nilai ECR dan RR
        $ecr = ($validatedData['item_s'] + $validatedData['item_l'] + $validatedData['item_p'] + $validatedData['item_e'] + $validatedData['item_b'] + $validatedData['item_h']) / 6;
        $rr = $ecr / $validatedData['item_r'];

        // Update data barang
        $barang->item_name = $validatedData['item_name'];
        $barang->item_no = $validatedData['item_no'];
        $barang->r = $validatedData['item_r'];
        $barang->s = $validatedData['item_s'];
        $barang->l = $validatedData['item_l'];
        $barang->p = $validatedData['item_p'];
        $barang->e = $validatedData['item_e'];
        $barang->b = $validatedData['item_b'];
        $barang->h = $validatedData['item_h'];
        $barang->ecr = $ecr;
        $barang->rr = $rr;
        $barang->status = 'Modified Need Review';
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


/* public function store(Request $request)
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
    $ecr = ($validatedData['item_s'] * $bobotArray[0]) +
           ($validatedData['item_l'] * $bobotArray[1]) +
           ($validatedData['item_p'] * $bobotArray[2]) +
           ($validatedData['item_e'] * $bobotArray[3]) +
           ($validatedData['item_b'] * $bobotArray[4]) +
           ($validatedData['item_h'] * $bobotArray[5]);

    // Hitung RR (jika perlu, berdasarkan logika Anda)
    $rr = $ecr * $validatedData['item_r'];

    // Simpan barang baru dengan ECR dan RR
    $barang = Barang::create(array_merge($validatedData, [
        'id_pabrik' => $a,
        'id_bagian' => $b,
        'ECR' => $ecr,
        'RR' => $rr,
        'status' => 'Created Need Review',
    ]));

    return response()->json(['success' => true, 'barang' => $barang]);
} */


public function store(Request $request)
{
    // Validasi data yang diterima
    $validatedData = $request->validate([
        'item_name' => 'required|string|max:255',
        'item_no' => 'required|string|max:255|unique:barangs,item_no',
        'item_r' => 'required|numeric',
        'item_s' => 'required|numeric',
        'item_l' => 'required|numeric',
        'item_p' => 'required|numeric',
        'item_e' => 'required|numeric',
        'item_b' => 'required|numeric',
        'item_h' => 'required|numeric',
    ],[
        'item_no.unique' => 'Item No sudah ada. Silakan gunakan nomor yang berbeda.',
    ]
);

    // Ambil nilai $a dan $b dari session
    $a = session('a', 1);
    $b = session('b', 1);

    // Ambil nilai bobot dari database
    $bobots = Bobot::all();
    $bobotArray = $bobots->pluck('nilai_bobot')->toArray();

    // Hitung ECR
    $ecr = ($validatedData['item_s'] * $bobotArray[0]) +
           ($validatedData['item_l'] * $bobotArray[1]) +
           ($validatedData['item_p'] * $bobotArray[2]) +
           ($validatedData['item_e'] * $bobotArray[3]) +
           ($validatedData['item_b'] * $bobotArray[4]) +
           ($validatedData['item_h'] * $bobotArray[5]);

    // Hitung RR (jika perlu, berdasarkan logika Anda)
    $rr = $ecr * $validatedData['item_r'];

    // Simpan barang baru dengan ECR dan RR
    $barang = Barang::create(array_merge($validatedData, [
        'id_pabrik' => $a,
        'id_bagian' => $b,
        'ECR' => $ecr,
        'RR' => $rr,
        'status' => 'Created Need Review',
        'R' => $validatedData['item_r'],
        'S' => $validatedData['item_s'],
        'L' => $validatedData['item_l'], 
        'P' => $validatedData['item_p'], 
        'E' => $validatedData['item_e'], 
        'B' => $validatedData['item_b'], 
        'H' => $validatedData['item_h'], 

        
    ] 
));

/*     return response()->json(['success' => true, 'barang' => $barang]);
 */    
return redirect()->route('item2.index')->with('success', 'Data berhasil disimpan');
}





public function approve($id, Request $request)
{
    /* $item = Barang::findOrFail($id);
    $item->status = 'Approved';
    $item->save();

    return response()->json(['success' => true]); */
    $item = Barang::findOrFail($id);

    if ($item->status == 'Deleted Need Review') {
        $item->delete();
        return response()->json(['success' => true, 'deleted' => true]);
    } else {
        $item->status = 'Approved';
        $item->save();
        return response()->json(['success' => true, 'deleted' => false]);
    }
}


/* public function rejectItem($id, Request $request)
    {
        $item = Barang::findOrFail($id);

        $item->status = 'Rejected';
        $item->save();

        return response()->json(['success' => true]);
    } */

    public function reject($id, Request $request)
{
    $item = Barang::findOrFail($id);
    $item->status = 'Rejected';
    $item->save();

    return response()->json(['success' => true]);
}


}
