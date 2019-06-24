<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function index()
    {
    	$reajuste = Reajuste::Select('porcentajeReajuste', 'porcentajeReajuste')
                            ->orderby('id','DESC')
                            ->get();
        // return view('inicio.index');
        
        return view('main', compact(
                  'reajuste'                
            ));
    }
    
}
