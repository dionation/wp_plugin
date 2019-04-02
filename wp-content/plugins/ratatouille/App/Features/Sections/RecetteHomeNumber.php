<?php
namespace App\Features\Sections;
class RecetteHomeNumber
{
  /**
   * Enregistrement de la section
   *
   * @return void
   */
  public static function init()
  {
    // https://developer.wordpress.org/reference/functions/add_settings_section/
    add_settings_section(
      'recette-home-number', // l'id (slug) de la section
      __('Nombre de recette sur la home'), // le titre de la section qui apparaîtra
      [self::class, 'render'], // la méthode qui affichera le contenu de la secttion
      'reading' // l'id de la page à la quelle on ajoute la section
    );
    self::register_settings(); // on en profite au moment d'initialiser la class (grâce à la ligne 10 dans Section.php qui elle même est lancée par la ligne 14 dans hooks.php) pour lancer également notre function register_settings() qui elle lance la function prédéfinie de wordpress register_setting() 'regardez bien la différence de syntaxe, register_settings() c'est une function qu'on à créer nous, et register_setting() c'est de wordpress.
  }
  // register_setting enregistre les setting de la section et ces données qu'on à entrée dans la base de donnée. il suffit de lui dire sur quelle page trouver ces données et quel champ récupérer, pour le coup nous on lui dit que c'est sur la page "reading" et qu'il faut récupérer la valeur de recette_home_number
  public static function register_settings()
  {
    // https://developer.wordpress.org/reference/functions/register_setting/
    register_setting(
      'reading', // ne slug de la page sur laquelle le setting se trouve
      'recette_home_number' // le name de l'input du setting
      // le troisème paramêtre est optionnel.
    );
  }

  /**
   * fonction pour render le contenu de la section
   */
  public static function render()
  {
    // On récupère les données personnalisées de notre section dans la BDD avec la function get_option
    // https://developer.wordpress.org/reference/functions/get_option/
    // Lisez la description dans la documentation officiel.
    $nbr_recette_home = get_option('recette_home_number');
    // Je compact ma variable pour la rendre accessible dans ma view.
    view('sections/recette-home-number',compact('nbr_recette_home'));
  }
  
}