<?php
namespace App\Database\Migrations;
class CreateMailTable
{
  /**
   * Création de la table
   *
   * @return void
   */
  public static function up()
  {
    // Nous récupérons l'objet $wpdb qui est global afin de pouvoir intéragir avec la base de donnée.
    global $wpdb;
    // $wpdb->prefix permet de récuper le prefix qu'on avait choisis quand on a créer notre base de donnée wordpress la toute première fois qu'on a lancé wp server apres notre wp core download
    $table_name = $wpdb->prefix . 'rat_mail';
    // nous utilisons la méthode query qui nous permet d'écrire une requette en SQL pure
    // Nous verrons plus tard l'écriture mysql en profondeur.
    // Vous pouvez avoir une preview sur comme construire cette requêtte.
    // https://dev.mysql.com/doc/refman/5.7/en/create-table.html
    $wpdb->query("CREATE TABLE IF NOT EXISTS  $table_name  (
      id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
      userid INT NOT NULL,
      lastname VARCHAR(255) NOT NULL,
      firstname VARCHAR(255) NOT NULL,
      email VARCHAR(255) NOT NULL,
      content TEXT NOT NULL,
      created_at TIMESTAMP
    )
    COLLATE utf8mb4_unicode_520_ci
    ;");
  }
}