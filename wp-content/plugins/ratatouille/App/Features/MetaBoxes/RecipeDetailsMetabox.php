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
    $data = get_post_meta(get_the_ID());
    $time = extract_data_attr('rat_time_preparation',$data);

    // Création d'une variable contenant la valeur qu'on a été chercher dans la base de donné grâce à get_post_meta(get_the_ID()) et qu'on assaini via le helper extract_data_attr()
    $nbr_personne = extract_data_attr('rat_nbr_personne',$data);

    // on rajout dans compact la seconde variable pour l'envoyer dans la view recipe-detail
    view('metaboxes/recipe-detail',compact('time','nbr_personne'));
  }

  /**
   * sauvegarde des données de la metabox
   *
   * @param [type] $post_id reçu par le do_action
   * @return void
   */

  public static function save($post_id)
  {    
    if (count($_POST) != 0) {
      $time_preparation = sanitize_text_field($_POST['rat_time_preparation']);   
      update_post_meta($post_id, 'rat_time_preparation', $time_preparation);

      // on assaini la valeur récupérée par la requête et on l'envoi dans la base de donnée.
      $nbr_personne = sanitize_text_field($_POST['rat_nbr_personne']);
      update_post_meta($post_id,'rat_nbr_personne', $nbr_personne);
    }
  }
} 