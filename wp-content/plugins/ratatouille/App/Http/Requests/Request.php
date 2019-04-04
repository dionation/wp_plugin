<?php

namespace App\Http\Requests;

class Request{

  // On créer une variable de type array.Pour le moment on n'en fait rien.
  private static $error = array();

  // On créer une function du nom de validation qui attend un paramètre de type array.Ce paramètre va être rempli via le fichier SendMail.php ligne 44.  
  public static function validation(array $data){
  
  }


}