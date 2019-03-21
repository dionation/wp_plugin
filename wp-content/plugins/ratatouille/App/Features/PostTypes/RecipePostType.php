<?php
// On définit un nom qu'on imagine unique vu sa complexité, une bonne pratique est que le nom soit équivalent au chemin pour atteindre le fichier dans le quel on se trouve.
namespace App\Features\PostTypes;

// On à Couper Coller notre function du fichier Ratatouille.php pour l'englobé avec une class
class RecipePostType
{
  public static function register()
  {
    register_post_type(
      'recipe', 
      [
        'labels' => [
          'name' => 'Recettes',
          'singular_name' => 'Recette',
        ],
        'public' => true,
        'has_archive' => true,
      ]
    );

  }
}