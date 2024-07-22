<?php

namespace App\Http\Controllers;
use App\Models\Bobot; 
use App\Models\Barang;

use Illuminate\Http\Request;
//import return type View
use Illuminate\View\View;

class ItemController extends Controller
{

   //

   /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all products
        $item = Barang::latest()->paginate(10);
 

        //get all products
        $bobots = Bobot::latest()->paginate(10);
        //$penggunas = Pengguna::latest()->paginate(10);

       //render view with products
      
        //render view with products
        return view('item.index', compact('item','bobots'));
        return view('item2.index', compact('item','bobots'));
        
    }

    
    public function update($id, Request $request)
    {
        $item = Item::findOrFail($id);
        $item->ecr = $request->input('ecr');
        $item->rr = $request->input('rr');
        $item->save();

        return response()->json(['success' => true]);
    }
}
