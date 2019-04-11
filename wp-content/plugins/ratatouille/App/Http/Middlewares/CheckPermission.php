<?php 
namespace App\Http\Middlewares;
class CheckPermission
{
  /**
   * Vérification des droits de l'utilisateur
   *
   * @param string $capability
   * @return void
   */
  public static function check(string $capability)
  {
    if (!current_user_can($capability)) {
      // si l'utilisateur n'a pas les permissions nécessaire, nous le redirigeons vers une page access denied
      view('code/403');
      // la déclaration exit permet d'arrêter l'execution du script
      exit;
    }
  }
}