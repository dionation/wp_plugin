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
    // Labels est un paramètre contenant un tableau dans le quel vous passerez plein de paramètre prédéfinie que vous retrouverez dans la documentation,parmis eux 'name' qui permet de modifier le nom par defaut qui est 'Article' que l'on va passé à 'Recette' 
    'labels' => [
      // Nom au pluriel apparent dans le menu ou quand c'est nécéssaire dans une phrase
      'name' => 'Recettes',
      // Nom au singulier 
      'singular_name' => 'Recette'

    ],
    'public' => false,
    // has_archive vous permet de vous rendre sur http://localhost:8080/index.php/recipe/ et d'y trouver toutes vos recettes si cela ne fonctionne pas c'est possible qu'il vous faille réecrire vos permaliens pour ce faire allez dans votre backoffice -> Settings -> Permaliens et cliquez sur Enregistrer les modifications,après avoir fait ça testez en passant de true a false actualisant votre page http://localhost:8080/index.php/recipe/ observez, repassez de false à true et actualisez puis observez.
    'has_archive' => true,
    ]

  );
}
add_action('init','register_recipe_post_type');