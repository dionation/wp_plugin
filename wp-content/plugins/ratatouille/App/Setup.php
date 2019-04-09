<?php
namespace App;
class Setup
{
  /**
   * Fonction pour démarrer une session afin de pouvoir utiliser la variable $_SESSION
   *
   * @return void
   */
  public static function start_session()
  {
    // on vérifie si une session n'existe pas déjà. Si non on en commence une
    if (!session_id()) {      
      // session_start() génère un ID accessible via session_id
      session_start();
    }
  }
  /*Fonction pour ajouter des script et css pour l'admin*/
  public static function enqueue_scripts($page)
  {
    // Cette css a été crée à partir des fichier scss de bootstrap en n'utilisant que la partie grid. Si vous essayez de reproduire cette action, sachez que j'ai du rajouter ceci manuellement *{box-sizing:border-box};
    wp_enqueue_style('admin-bootstrap-grid', RAT_PLUGIN_URL . "/resources/assets/css/bootstrap-grid.css");
  }
}