<?php

namespace App\Http\Requests;

class Request{

  // On créer une variable de type array.Pour le moment on n'en fait rien.
  private static $error = array();

  // On créer une function du nom de validation qui attend un paramètre de type array.Ce paramètre va être rempli via le fichier SendMail.php ligne 44.  
  public static function validation(array $data){
  // Pour chaque entrée on lance une des méthode ci dessous selon la valeur du tableau $data
  // Data est un tableau de clé => valeur dont la clé est le "name" de l'input et la valeur est la méthode de vérification que l'on veut appliquer sur le contenu de l'input. C'est nous qui avons fait en sorte que les valeurs du tableau $data correspondent aux names de nos inputs dans notre formulaire.
  foreach ($data as $input_name => $verification) {
    // on lance la function de la class, 'email' ou 'required' selon ce que vaut $verification et on rempli le paramètre de la function avec $input_name
    call_user_func([self::class, $verification], $input_name);
  }
  
  }

  public static function required(string $input){

  }

  public static function email(string $input){
    
  }

}