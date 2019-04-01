<?php
namespace App\Features\Sections;
/**
 * Cette class charge toutes les sections grâce à sa méthode init
 */
class Section
{
  public static function init()
  {
    RecetteHomeNumber::init();
  }
}