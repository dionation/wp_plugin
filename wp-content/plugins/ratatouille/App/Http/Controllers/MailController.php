<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;

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
      global $wpdb;
      // Nous utilisons une fonction pour insérer dans la db. https://developer.wordpress.org/reference/classes/wpdb/insert/
      $wpdb->insert(
        $wpdb->prefix . 'rat_mail', // premier argument est le nom de la table. c'est la deuxième fois que l'on écrit ce nom. Il serait bon de faire un refactoring et d'utiliser une constante à la place. Nous le ferons plus tard.
        [ // Deuxième paramêtre est un tableau dont la clé est le nom de la colonne dans la table et la valeur est la valeur à mettre dans la colonne
        // Colonne => Valeur
          'userid' => get_current_user_id(),
          'lastname' => $name,
          'firstname' => $firstname,
          'email' => $email,
          'content' => $message,
          'created_at' => current_time('mysql')
        ]
      );
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