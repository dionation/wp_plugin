<?php
namespace App\Features\Roles;
class Role
{
  /**
   * Fonction d'initialisation des roles
   *
   * @return void
   */
  public static function init()
  {
    // Voici une liste des capabilities(permissions) qui existent déjà dans wordpress 
    // https://codex.wordpress.org/Roles_and_Capabilities
    // Notre but est de créer deux nouveaux roles avec des droits différent, manager et assistant, avant de créer ces roles on commence par créer des noms de permissions dont nous nous servirons par la suite.
    // Déclaration des permissions pour le manager de mail
    $manager_capabilities = [
      "read_email" => true,
      "show_email" => true,
      "create_email" => true,
      "edit_email" => true,
      "delete_email" => true,
    ];
    // Déclaration des permissions pour l'assistant mail
    $assistant_capabilities = [
      "read_email" => true,
      "show_email" => true,
    ];
  }
}