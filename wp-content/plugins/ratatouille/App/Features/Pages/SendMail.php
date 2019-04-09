<?php
namespace App\Features\Pages;
use App\Http\Models\Mail;
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
  public static function render()
  {
    /**
     * on fait un refactoring afin que la méthode render renvoi vers la bonne méthode en fonction de l'action
     */
    // on défini une valeur par défaut pour $action qui est index et qui correspondra à la méthode à utiliser(celle qui renvoi la vue avec tous les mails et le formulaire)
    $action = isset($_GET["action"]) ? $_GET["action"] : "index";
    call_user_func([self::class, $action]);
  }
  public static function index()
  {
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
    // Maintenant qu'on est ici on à besoin de savoir quel mail est demandé on va donc dans notre url voir que vaut id= ?? et on le stock dans une variable $id
    $id = $_GET['id'];
    // on fait appel à notre function find et dans passe en paramètre l'id pour que notre function sache l'émail à aller chercher dans notre BDD
    $mail = Mail::find($id);
    // on retourn une vue avec le contenu de Mail, cette vue n'est pas encore crée nous allons la crée au prochain commit. A présent la vue existe et donc on peut y utiliser la variable mail qu'on compact.
    view('pages/show-mail', compact('mail'));
  }

}