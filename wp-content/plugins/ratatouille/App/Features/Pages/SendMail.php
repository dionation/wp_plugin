<?php
namespace App\Features\Pages;
class SendMail
{
  /**
   * Initialisation de la page.
   *
   * @return void
   */
  public static function init()
  {
    //https: //developer.wordpress.org/reference/functions/add_menu_page/  
    add_menu_page(
      __('Formulaire pour contacter les clients'), // Le titre qui s'affichera sur la page
      __('Mail Client'), // le texte dans le menu
      'edit_private_pages', // la capacité qu'il faut posséder en tant qu'utilisateur pour avoir accès à cette page (les roles et capacité seront vue plus tard)
      'mail-client', // Le slug du menu
      [self::class, 'render'], // La méthode qui va afficher la page
      'dashicons-email-alt', // L'icon dans le menu
      26 // la position dans le menu (à comparer avec la valeur deposition des autres liens menu que l'on retrouve dans la doc).
    );
  }
  /**
   * Affichage de la page
   *
   * @return void
   */
  public static function render()
  {
    view('pages/send-mail');
  }

  public static function send_mail()
  {
    // Nous récupérons les données envoyé par le formulaire qui se retrouve dans la variable $_POST
    $email = sanitize_email($_POST['email']);
    $name = sanitize_text_field($_POST['name']);
    $firstname = sanitize_text_field($_POST['firstname']);
    $message = sanitize_textarea_field($_POST['message']);

    // Ob_start début de la session de temporisation du contenu,cela permet de séquencer le travail(de compresser le contenu) et ainsi rendre le travail plus efficace pour la machine donc plus rapide de traité les données qui seront décompréssé par la suite à la demande du client(quand il s'en sert) C'est un peu comme si vous téléchargié un dossier en format zip/rar qui ferait 500mo car il est compréssé et une fois que vous devez l'utilisez vous le décompressé et en réalité il fait 1Giga de poids.Vous l'avez obtenu beaucoup plus vite que si vous deviez télécharger 1Giga.
    // https://www.php.net/manual/fr/function.ob-start.php
    ob_start();
    // on y instaure le contenu qui est en fait le contenu d'une page qu'on appel avec notre helper view
    view('pages/template-mail');
    // retourne le contenu qu'on stock dans une variable et une fois que c'est fait il ferme la session
    $mail=ob_get_clean();

    // on change $message par $mail cela veut dire qu'on envoi plus message dans le contenu du mail mais ce qui est retourné par $mail c'est à dire le contenu de notre page template-mail.html.php
    wp_mail($email, 'Pour ' . $name . ' ' . $firstname, $mail);
    // la fonction wp_safe_redirect redirige vers une url. La fonction wp_get_referer renvoi vers la page d'ou la requête a été envoyé.
    wp_safe_redirect(wp_get_referer());
  }
}