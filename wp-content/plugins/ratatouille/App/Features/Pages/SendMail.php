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
    // on créer un 5ème paramètre que l'on va passer a notre function wp_mail,il nous permet d'interpeté le contenu de notre message(le contenu de template-mail.html.php)
    $header='Content-Type: text/html; charset=UTF-8';

    // on à remplacé notre pavé par un helper qui le contient et on le stock dans une variable qu'on passe à notre wp_mail.
    $mail = mail_template('pages/template-mail',compact('name','firstname','message'));
  
    // A chaque fois qu'on lance de formulaire d'envoi de mail on rajout dans $_SESSION un tableau notice avec deux clefs et leur valeur.
    $_SESSION['notice'] = [
      'status' => 'success',
      'message' => 'votre e-mail a bien été envoyé'
    ];

    // on rajout $header en 5ème paramètre
    wp_mail($email, 'Pour ' . $name . ' ' . $firstname, $mail,$header);
    // la fonction wp_safe_redirect redirige vers une url. La fonction wp_get_referer renvoi vers la page d'ou la requête a été envoyé.
    wp_safe_redirect(wp_get_referer());
  }
}