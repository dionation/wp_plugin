<?php

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