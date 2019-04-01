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
  }
  /**
   * fonction pour render le contenu de la section
   */
  public static function render()
  {
    view('sections/recette-home-number');
  }
}