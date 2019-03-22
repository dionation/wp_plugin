<?php
// Dés qu'on fait appel a une class comme c'est le cas à la ligne 24 du fichier ratatouille.php la fonction spl_autoload_register est automatiquement lancée,elle lance à son tour la fonction qu'elle à en paramètre 'simplarity_autoloader' et à la même occasion elle remplie le paramètre de la fonction simplarity_autoloader avec la classe qui la lancée.
spl_autoload_register('simplarity_autoloader');

// $class_name contient la class RecipePostType
function simplarity_autoloader($class_name)
{
  // Si le namespace de la class contient App alors on rentre dans la fonction
  if (strpos($class_name, 'App') !== false) {
    // __FILE__ correspond au fichier dans le quel on est 'autoload.php', la fonction plugin_dir_path retourne le chemin jusqu'au dossier contenant __FILE__ on stock ce chemin dans une variable $classes_dir
     $classes_dir = plugin_dir_path(__FILE__);

    // on modifie la syntaxe de la class name pour passé de "App\Features\PostTypes\RecipePostType" par "App/Features/PostTypes/RecipePostType.php" voila ce que fait la combinaison de la fonction strp_replace et de l'argument DIRECTORY_SEPARATOR 
    // http://php.net/manual/fr/function.str-replace.php
    // DIRECTORY_SEPARATOR générera "/" ou "\" selon le systeme d'expoitation de la machine 
    $class_file = str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';
    require_once $classes_dir . $class_file;
  }
} 