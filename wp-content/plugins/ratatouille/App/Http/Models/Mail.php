<?php


namespace App\Http\Models;

class Mail
{
  // les propriétés de l'objet model. Les propriété de l'objet qui sont représentative de la structure de la table dans la base de donnée.
  public $id;
  public $userid;
  public $lastname;
  public $firstname;
  public $email;
  public $content;
  public $created_at;
  protected static $table = 'wp_rat_mail';
  /**
   * Fonction qui est appelé lors de l'instance d'un objet.
   */
  public function __construct()
  {
    // on rempli déjà la date de création
    $this->created_at = current_time('mysql');
  }
  /**
   * fonction qui prend en charge la sauvegarde du mail dans la base de donnée.
   *
   * @return void
   */
  public function save()
  {
    global $wpdb;
    // nous utilisons à nous la méthode insert de l'objet $wpdb;
    return $wpdb->insert(
      $wpdb->prefix . 'rat_mail', // le nom de la table
      // ici nous affichons toutes les colonnes avec leur valeur sous forme d'objet.
      [
        'id' => $this->id,
        'userid' => $this->userid,
        'lastname' => $this->lastname,
        'firstname' => $this->firstname,
        'email' => $this->email,
        'content' => $this->content,
        'created_at' => $this->created_at
      ]
    );
  }
  // On créer une function qui récupère tous les mails qui ont été enregistré dans la base de donnée,on créer plus haut ligne 16 de ce fichier une variable dans le quel on stock le nom de la table qui contient les mails, ce nom de table on l'avait défini quelques commits plus tot ligne 35 de ce fichier.
  public static function all()
  {
    global $wpdb;
    $table = self::$table;
    $query = "SELECT * FROM $table";
    return $wpdb->get_results($query);
  }
}