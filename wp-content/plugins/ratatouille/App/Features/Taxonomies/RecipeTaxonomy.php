<?php
namespace App\Features\Taxonomies;
use App\Features\PostTypes\RecipePostType;



// Voici le strict nécéssaire, j'ai simplement créer une class, avec une function que j'ai appelé register et cette function lance la function prédéfinie register_taxonomy avec comme premier paramètre doit être un identifiant,le second argument est à qui on va attribué notre taxonomy, on pourrait y mettre 'post' ou 'page' cest a dire qu'on rendrais accessible notre taxonomy dans les article ou dans les pages, à vous d'essayer. Mais pour le coup ici on rend notre taxonomy accessible dans notre post_type recette en ciblant son identifiant. Le troisème argument est optionnel nous verrons cela au prochain commit.
// Vous pouvez observez qu'une taxonomy à bien été rajouté mais qu'elle s'appelle "Etiquette",c'est un nom qui est donné par défaut car au final tout ce qu'on a fait c'est uniquement initialiser une taxonomy avec l'aide de la function register_taxonomy et de la raccroché à notre post_type recette.

class RecipeTaxonomy {

  public static $slug = 'recipe_taxonomy';

  /**
   * Enregistrement de la Taxonomie
   * https://developer.wordpress.org/reference/functions/register_taxonomy/
   * @return void
   */
  public static function register(){
    
    $labels = [ // Rajouts des labels
      'name' => __('Type de recettes'),
      'singular_name' => __('Type de recette'),
    ];
    $args = [ // Rajout d'arguments
      'labels' => $labels,
    ];
    
    // J'ai créer un tableau ou j'ai mis deux labels, en suit dans les $args j'ai utilisé un seul paramètre c'est 'labels' au quel j'ai donné la valeur $labels, j'ai fini par passé $args en troisème paramètre à la fonction register_taxonomy,vous pouvez aller observer les changements.
    register_taxonomy(self::$slug, [RecipePostType::$slug],$args);
  }
}