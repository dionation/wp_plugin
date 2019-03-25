<?php
namespace App\Features\MetaBoxes;
use App\Features\PostTypes\RecipePostType;
class RecipeDetailsMetabox
{
  public static $slug = 'recipe_details_metabox';
  /**
   * Ajout d'une méta box au type de contenu qui sont passer dans le tableau $screens
   * https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/
   *
   * @return void
   */
  public static function add_meta_box()
  {
    $screen = [RecipePostType::$slug];
      add_meta_box(
        self::$slug,           // Unique ID
        __("Détails de la cette"),  // Box title
        [self::class, 'render'],  // Content callback, must be of type callable
        $screen                   // Post type
      );
  }
  /**
   * Fonction pour rendre le code html dans la metabox
   *
   * @return void
   */
  public static function render()
  {
    // chemin jusqu'au dossier dans le quel on est,cela retourne /home/utilisateur/Bureau/dossier-du-projet,pour ma part j'ai obtenu :
    // /home/benefit/Bureau/training/wppluginpractice
    $path_racine = $_SERVER["DOCUMENT_ROOT"];
    // Vous pouvez faire un echo si vous le désirez
    // echo $path_racine;
    // A ceci je concatène le reste du chemin jusqu'a arrivé dans le fichier recipe-detail-html
    include($path_racine . '/wp-content/plugins/ratatouille/resources/views/metaboxes/recipe-detail.html.php');
  }
} 