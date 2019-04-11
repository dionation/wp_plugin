<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Http\Models\Mail;
use App\Http\Middlewares\CheckPermission;
class MailController
{
  public static function send()
  {
    // Vérification des permissions
    CheckPermission::check('create_email');
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
  public static function index()
  {
    // Vérification des permissions
    CheckPermission::check('read_email');
    // on va chercher toute les entrés de la table dont le model mail s'occupe et on inverse l'ordre afin d'avoir le plus récent en premier.
    $mails = array_reverse(Mail::all());
    // Si $_SESSION['old'] existe alors on déclare une variable $old dans la quelle on stock son contenu puis on detruit notre global $_SESSION['old']
    if (isset($_SESSION['old'])) {
      $old = $_SESSION['old'];
      unset($_SESSION['old']);
    }
    // on envoi notre variable $old qui contient les anciennes valeurs dans notre view send-mail pour qu'on puisse afficher son contenu dans les champs.
    view('pages/send-mail',compact('old','mails'));
  }
    /**
   * Affiche une entré en particulier
   *
   * @return void
   */
  // on entre ici car on à cliqué sur le lien 'voir' donc dans notre url on a 'action=show' qui s'est rajouté et notre call_user_func à donc fait appel à show() ici même
  public static function show()
  {
    // Vérification des permissions
    CheckPermission::check('show_email');
    // Maintenant qu'on est ici on à besoin de savoir quel mail est demandé on va donc dans notre url voir que vaut id= ?? et on le stock dans une variable $id
    $id = $_GET['id'];
    // on fait appel à notre function find et dans passe en paramètre l'id pour que notre function sache l'émail à aller chercher dans notre BDD
    $mail = Mail::find($id);
    // on retourn une vue avec le contenu de Mail, cette vue n'est pas encore crée nous allons la crée au prochain commit. A présent la vue existe et donc on peut y utiliser la variable mail qu'on compact.
    view('pages/show-mail', compact('mail'));
  }
  // function qui est lancé via le hook admin_action_mail-delete ligne 23 du fichier hooks.php.
  public static function delete()
  {
    // Vérification des permissions
    CheckPermission::check('delete_email');
    // on récupère l'id envoyé via $_POST notre formulaire ligne 29 dans show-mail.html.php
    $id = $_POST['id'];
    // si notre function delete($id) est lancée alors on rempli SESSION avec un status et un message positif puis on redirect sur notre page mail-client
    if (Mail::delete($id)) {
      $_SESSION['notice'] = [
        'status' => 'success',
        'message' => 'Le mail a bien été supprimé'
      ];
      wp_safe_redirect(menu_page_url('mail-client'));
    } 
    // Si le mail na pas été supprimé on renvoi sur la page avec une notification négative
    else {
      $_SESSION['notice'] = [
        'status' => 'error',
        'message' => 'un Problème est survenu, veuillez rééssayer'
      ];
      wp_safe_redirect(wp_get_referer());
    }
  }
  // function qui permet d'aller dans le BDD récupérer le mail dont l'id à été envoyé en POST via le link dans l'url
  public static function edit()
  {
    // Vérification des permissions
    CheckPermission::check('edit_email');
    $id = $_GET['id'];
    $mail = Mail::find($id);
    view('pages/edit-mail', compact('mail'));
  }

  // On récupère les données du formulaire d'update avec une verification du nonce, et les validations. en suit on va chercher toutes les données passé dans $_POST par notre formulaire on y applique un sanitize sur chaque donnée, en suit on lance la function update() qui vient de notre model Mail.php
  public static function update()
  {
    // Vérification des permissions
    CheckPermission::check('edit_email');
    // on vérifie la sécurité pour voir si le formulaire est bien authentique
    if (!wp_verify_nonce($_POST['_wpnonce'], 'edit-mail')) {
      return;
    };
    // on vérifie les valeurs
    Request::validation([
      'lastname' => 'required',
      'email' => 'email',
      'firstname' => 'required',
      'content' => 'required'
    ]);
    // on récupère le mail original de la base de donnée
    $mail = Mail::find($_POST['id']);
    // On met à jour les nouvelles valeurs
    $mail->userid = get_current_user_id();
    $mail->lastname = sanitize_text_field($_POST['lastname']);
    $mail->firstname = sanitize_text_field($_POST['firstname']);
    $mail->email = sanitize_email($_POST['email']);
    $mail->content = sanitize_textarea_field($_POST['content']);
    // on met à jour dans la base de donnée et on renvoi une notification
    if ($mail->update()) {
      $_SESSION['notice'] = [
        'status' => 'success',
        'message' => 'votre e-mail a bien été modifié'
      ];
    } else {
      $_SESSION['notice'] = [
        'status' => 'error',
        'message' => 'Une erreur est survenu, veuillez réessayer plus tard'
      ];
    }
    wp_safe_redirect(wp_get_referer());
  }
}