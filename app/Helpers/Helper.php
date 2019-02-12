<?php

namespace App\Helpers;

class Helper
{
   // public static function myMethod()
   // {
   //    return "my method";
   // }


   public static function rut( $rut ) {
      //return number_format( substr ( $rut, 0 , 1 ) , 0, "", ".") . '-' . substr ( $rut, strlen($rut) 1 , 1 );
      //
      return $rut;
   }

   	public static function msgEliminado( $gramatica, $texto, $registro ) {
      
      	if ($gramatica == 'F') {      		
       		return 'La '. $texto .' <b>'.$registro.'</b>, fue eliminada correctamente.';
   		} else if ($gramatica == 'M') {
   		 return 'El '. $texto .' <b>'.$registro.'</b>, fue eliminado correctamente.';
   		}
   	}

}

?>
