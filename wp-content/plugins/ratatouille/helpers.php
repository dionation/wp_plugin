<?php
/**
 * fonction pour rendre une view
 *
 * @param string $path chemin du fichier à partir du dossier views sans l'extention .html.php
 * @return void
 */
// Rajout d'un second paramètre qui par défaut vaut un tableau vide.
function view($path,$data = array())
{
  // https://www.php.net/manual/fr/function.extract.php
  extract($data);
  // Cette function = helper, me permet de faire un include plus rapidement je récupère juste le chemin du fichier à partir du dossier views sans l'extention dans le fichier RecipeDetailsMetabox.php ligne 31 que j'envoi en paramètre,ce chemin est envoyé dans la variable $path, puis je complète le chemin avec ma variable global et l'extention.
  include(RAT_VIEW_DIR . $path . '.html.php');
} 

/**
 * Extrait la valeur dans un tableau si la valeur existe dans ce tableau
 * cela permet de ne pas avoir d'erreur lorsque l'on créer un nouveau post
 *
 * @param string $key la meta key dans la base de donnée
 * @param array $data le tableau resultant de get_post_meta
 * @return void
 */
function extract_data_attr(string $key, array $data)
{
  // Vérification que la clé exist bien dans le tableau
  if (array_key_exists($key, $data)) {
    // on renvoi la valeur et on en profite pour échapper la valeur pour la sécurité
    return esc_attr($data[$key][0]);
  }
  return '';
}