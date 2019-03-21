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

// Appel de la class pour pouvoir utiliser sa function register
add_action('init',[RecipePostType::class, 'register']);

