<?php

namespace App\Http\Controllers;

use App\Models\Bobot; 

use Illuminate\Http\Request;
//import return type View
use Illuminate\View\View;

class BobotController extends Controller
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
        $bobots = Bobot::latest()->paginate(10);

       //render view with products
      
       return view('bobots.index', compact('bobots'));

    }

    
}

<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BobotController extends Controller
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
        $bobots = Bobot::latest()->paginate(10);

        //render view with products
        return view('bobots.index', compact('bobots'));
    }
}
