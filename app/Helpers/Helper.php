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

   public static function peso_chileno($numero){
      $numero = (string)$numero;
      $puntos = floor((strlen($numero)-1)/3);
      $tmp = "";
      $pos = 1;
      for ($i = strlen($numero) - 1; $i >= 0; $i--) {
         $tmp = $tmp.substr($numero, $i, 1);
         if ($pos % 3 == 0 && $pos != strlen($numero))
         $tmp = $tmp.".";
         $pos = $pos + 1;
      }
      $formateado = "$".strrev($tmp);
      return $formateado;
   }

   public static function miles($numero){
      $numero = (string)$numero;
      $puntos = floor((strlen($numero)-1)/3);
      $tmp = "";
      $pos = 1;
      for ($i = strlen($numero) - 1; $i >= 0; $i--) {
         $tmp = $tmp.substr($numero, $i, 1);
         if ($pos % 3 == 0 && $pos != strlen($numero))
         $tmp = $tmp.".";
         $pos = $pos + 1;
      }
      $formateado = strrev($tmp);
      return $formateado;
   }
}

?>
