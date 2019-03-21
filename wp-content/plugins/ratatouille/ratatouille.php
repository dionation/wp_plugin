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

// Importation du fichier RecipePostType avec la function php 'require_once' 
// http://php.net/manual/fr/function.require-once.php
require_once('App/Features/PostTypes/RecipePostType.php');

// Appel de la class venant du namespace qu'on a définit dans le fichier RecipePostType.php ,l'avantage c'est qu'on a redéfinit le nom de notre class qui était RecipePostType par App\Features\PostTypes\RecipePostType il y a maintenant presque aucune chance qu'un autre plugin utilise le meme nom de class et donc il n'y aura pas de conflit.
add_action('init',[App\Features\PostTypes\RecipePostType::class, 'register']);

