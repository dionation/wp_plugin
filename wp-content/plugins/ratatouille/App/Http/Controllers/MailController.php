<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Http\Models\Mail;

class MailController
{
  public static function send()
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

      // Nous allons également sauvegarder en base de donnée les mails que nous avons envoyé.
          // Refactoring pour apprendre et utiliser les models. Seul les models peuvent intéragir avec la base de donnée.
      // on instancie la class Mail et on rempli les valeurs dans les propriétés.
      $mail = new Mail();
      $mail->userid = get_current_user_id();
      $mail->lastname = $name;
      $mail->firstname = $firstname;
      $mail->email = $email;
      $mail->content = $message;
      // Sauvegarde du mail dans la base de donnée
      $mail->save();
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