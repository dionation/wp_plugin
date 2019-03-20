<?php
/**
 * Plugin Name:     Ratatouille
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     ratatouille
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Ratatouille
 */

// Your code starts here.


// Minimum requis pour que le plugin après avoir été activé dans les plugins,apparaissent dans le menu à gauche.
// Il apparaîtra sous le nom 'Article' car c'est un nom attribué par défaut,nous verrons dans le prochain commit comment modifier cela.
function register_recipe_post_type(){
  // register_post_type permet de rajouter un post-type dans votre menu, de base il existe des post type tel que 'PAGE' ou 'POST'(article) et bien d'autre,notre but va être de créer un nouveau post type qui sera 'Recipe'(recette en français)
  // https://developer.wordpress.org/reference/functions/register_post_type/
  register_post_type('recipe',
  [
    'public' => true
    ]

  );
}
add_action('init','register_recipe_post_type');