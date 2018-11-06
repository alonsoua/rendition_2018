<?php

namespace App\Helpers;

class Helper
{
   // public static function myMethod()
   // {
   //    return "my method";
   // }


   public static function rut( $rut ) {
      return number_format( substr ( $rut, 0 , -1 ) , 0, "", ".") . '-' . substr ( $rut, strlen($rut) -1 , 1 );
   }
}

?>
