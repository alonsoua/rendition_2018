<?php

namespace App\Http\Controllers;

// use App\Http\Requests\ReajusteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use App\Ano;
use App\Reajuste;





class ReajusteController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:reajuste.create')->only(['create', 'store']);
        $this->middleware('permission:reajuste.index')->only(['index']);
        $this->middleware('permission:reajuste.edit')->only(['edit', 'update']);
        $this->middleware('permission:reajuste.show')->only(['show']);
        $this->middleware('permission:reajuste.destroy')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
               
        $anosRaw = Ano::selectRaw('CONCAT(ano) as nombre, id')
                            ->orderby('id','DESC')
                            ->where('estado', '1')
                            ->get();
        

        $anoSelected = Ano::selectRaw('CONCAT(ano) as nombre, id')
                            ->orderby('id','DESC')
                            ->where('estado', '1')
                            ->take(1)
                            ->get();

        $reajustes = Reajuste::Select('idAno', 'porcentajeReajuste')
        					->orderby('id','DESC')
        					->get();
        
        $anos = $anosRaw->pluck('nombre', 'id');            

        return view('mantenedor.reajustes.index'
        , compact(
                      'anos',
                      'anoSelected',
                      'reajustes'
                ));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {          

            // Validaciones           
            Request()->validate([            	
                'ano'       		 => 'required',
                'porcentajeReajuste' => 'required|numeric',                    
            ]);   

            $reajusteExiste = Reajuste::where('idAno', '=', $request->ano)->get();

            if (count($reajusteExiste) != 0) {
            
	            $ano2 = Ano::findOrFail($request->ano);

            	$mensaje = "Ya se encuentra calculado el reajuste para el año <b>".$ano2->ano."</b>, el reajuste se calcula una vez por periodo, intente con otro año.";
            	$reload = 'no';
            } else {
	        	// dd($request->all());
	            DB::transaction(function () use ($request){
	                             
	                // Crea Liquidacion            
	                $reajuste = Reajuste::Create([
	                    'idAno'  			 => $request->ano,
	                    'porcentajeReajuste' => $request->porcentajeReajuste,                                  
	                ]);
	            }); 
	            
	            //Devuelve info a mostrar en el mensaje
	            $ano = Ano::findOrFail($request->ano); 
	 
	            //MENSAJE
	            $mensaje = 'El Calculo Reajuste para el año <b>'.$ano->ano.'</b>';            
	            $mensaje .= ' ha sido agregado correctamente.';
	            $reload = 'ok';
            	
            }

            return response()->json([                
                "message" => $mensaje,
                "reload" => $reload
            ]);
        }     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CalculoHora  $calculoHora
     * @return \Illuminate\Http\Response
     */
    public function show(CalculoHora $calculoHora)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CalculoHora  $calculoHora
     * @return \Illuminate\Http\Response
     */
    public function edit(CalculoHora $calculoHora)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CalculoHora  $calculoHora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalculoHora $calculoHora)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CalculoHora  $calculoHora
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalculoHora $calculoHora)
    {
        //
    }
}
