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
    // Récupération de toutes les metadata du post
    // https://developer.wordpress.org/reference/functions/get_post_meta/
    $data = get_post_meta(get_the_ID());
    $time = $data['rat_time_preparation'][0];
    
    // Ancienne façon : view('metaboxes/recipe-detail',['time_choisi' => $time]);
    // Nouvelle façon de passer les données, avec l'aide de la function compact()
    // La function compact créer un tableau ou elle met en clef le nom de la variable qu'on lui passe,on lui passe cette variable d'une manière assez particulière car on lui retire le '$' et qu'en plus on la met entre guillemet. En lui passant de cette manière elle créer donc un tableau avec comme clef et valeur le meme nom ce qui donne en soit : ['time' => $time] ca veux dire également qu'on doit aller changer dans recipe-detail.html.php le nom de la clef a la quelle on fait appel.
    view('metaboxes/recipe-detail',compact('time'));
  }

  /**
   * sauvegarde des données de la metabox
   *
   * @param [type] $post_id reçu par le do_action
   * @return void
   */

  //$post_id est remplie par l'id du post contenu dans l'url de la page
  public static function save($post_id)
  {
    // On verifie que $_POST ne soit pas vide pour effectuer l'action uniquement à la sauvegarde du post Type
    // $_POST est une variable globale php qui contient les données qu'on envoi via un formulaire,notre page recette n'est en soit qu'un formulaire avec des inputs et des textarea qu'on rempli et ce qu'on dit en soit c'est :
    // Si notre $_POST est différent de vide alors on execute les lignes suivantes
    if (count($_POST) != 0) {

      // On stock dans une variable la valeur de l'input dont le name est 'rat_time_preparation'
      // on ajoute sanitize pour sécurizer les valeurs receuilli par l'utilisateur
      // https://developer.wordpress.org/themes/theme-security/data-sanitization-escaping/
      $time_preparation = sanitize_text_field($_POST['rat_time_preparation']);   

      // On rajout la valeur stocké dans $time_preparation dans la base de donnée avec comme clef 'rat_time_preparation' ca veux dire que par exemple si la valeur rentré et '15-30' on retrouvera cette valeur 15-30 avec comme étiquette 'rat_time_preparation'
      // https://developer.wordpress.org/reference/functions/update_post_meta/
      update_post_meta($post_id, 'rat_time_preparation', $time_preparation);
    }
  }
} 