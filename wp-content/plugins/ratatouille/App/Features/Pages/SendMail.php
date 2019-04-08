<?php
namespace App\Features\Pages;
// on use la class Request pour pouvoir nous en servir plus bas,ligne 44.
use App\Http\Requests\Request;

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
    // Si $_SESSION['old'] existe alors on déclare une variable $old dans la quelle on stock son contenu puis on detruit notre global $_SESSION['old']
    if (isset($_SESSION['old'])) {
      $old = $_SESSION['old'];
      unset($_SESSION['old']);
    }
    // on envoi notre variable $old qui contient les anciennes valeurs dans notre view send-mail pour qu'on puisse afficher son contenu dans les champs.
    view('pages/send-mail',compact('old'));
  }

  public static function send_mail()
  {
    // on vérifie la sécurité pour voir si le formulaire est bien authentique,que le formulaire envoyé est bien celui de notre page
    if (!wp_verify_nonce($_POST['_wpnonce'], 'send-mail')) {
      return;
    };

    // Maintenant à chaque fois qu'il y a une tenative réussie ou ratée d'envoi de mail, on lance la methode 'validation' de la class Request et on rempli son paramètre avec un tableau de clef et de valeur. On fait en sorte que le nom des clefs correspondent aux names des inputs du formulaire.
    Request::validation([
      'name' => 'required',
      'email' => 'email',
      'firstname' => 'required',
      'message' => 'required'
    ]);


    // Nous récupérons les données envoyé par le formulaire qui se retrouve dans la variable $_POST
    $email = sanitize_email($_POST['email']);
    $name = sanitize_text_field($_POST['name']);
    $firstname = sanitize_text_field($_POST['firstname']);
    $message = sanitize_textarea_field($_POST['message']);
    // on créer un 5ème paramètre que l'on va passer a notre function wp_mail,il nous permet d'interpeté le contenu de notre message(le contenu de template-mail.html.php)
    $header='Content-Type: text/html; charset=UTF-8';

    // on à remplacé notre pavé par un helper qui le contient et on le stock dans une variable qu'on passe à notre wp_mail.
    $mail = mail_template('pages/template-mail',compact('name','firstname','message'));
  
    // Si le mail est bien envoyé status = 'success' sinon 'error'
    if(wp_mail($email, 'Pour ' . $name . ' ' . $firstname, $mail,$header)) {
      $_SESSION['notice'] = [
        'status' => 'success',
        'message' => 'votre e-mail a bien été envoyé'
      ];
    } else {
      $_SESSION['notice'] = [
        'status' => 'error',
        'message' => 'Une erreur est survenue, veuillez réessayer plus tard'
      ];
    }
    // la fonction wp_safe_redirect redirige vers une url. La fonction wp_get_referer renvoi vers la page d'ou la requête a été envoyé.
    wp_safe_redirect(wp_get_referer());
  }
}