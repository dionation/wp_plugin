<?php
/**
 * Plugin Name:     Ratatouille
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     ratatouille
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Ratatouille
 */

// Your code starts here.

require_once('autoload.php');

require_once('bootstrap.php');


// On créer des variables avec des functions wordpress le but et que vous analysiez chaque lignes pour voir ce que valent les variables.

// wp_roles https://developer.wordpress.org/reference/functions/wp_roles/
// Je retrouve dans $lesRoles la liste des roles prédéfinie par wordpress wp_roles nous donne un objet avec des propriétés tel que : roles, role_objects, roles_names etc
$lesRoles = wp_roles();// mettez votre point d'arret sur cette ligne et avancé avec la fleche en arc pour voir son contenu
// J'entre plus profondément dans la propriété roles et donc je le fait grâce à la fleche et je stock ce que cela contient dans une variable pour l'observer. Je vois que j'ai un tableau avec deux éléments qui sont name et capabilities.
$lesRolesProfondeur = wp_roles()->roles;
// La je fais en sorte de n'avoir que la clef administrator et j'obtient donc qu'une seule ligne
$leRoleAdministrator= wp_roles()->roles['administrator'];
// La j'utilise une autre function de wordpress qui m'évite de devoir écrire wp_roles()->roles['administrator']; pour avoir la ligne administrator et qui est get_role('leNameDuRole')
$leRoleAdministratorSecondFacon= get_role('administrator');
// On doit également se pencher sur la liste des capabilities, on peut voir que dans la liste de 'administrator' qu'il y a 61 capabilities je pense que c'est le total qu'il en existe pas d'autre
$adminCapabilities = get_role('administrator')->capabilities;
// Par contre si l'on regarde les capabilities de editor il y en a que 34
$editorCapabilities = get_role('editor')->capabilities;

// On va maintenant voir comment rajouter ou retirer des capabilities 
// https://developer.wordpress.org/reference/classes/wp_roles/
// Si on regarde le class wp_roles on peut voir qu'il y a des methods 'add_cap' et 'remove_cap'
// Tout dabord on doit cibler un role.

$editor=get_role('editor');
// Je regarde maintenant dans la liste des capabilities de l'editor et je vais supprimer les capabilities 'moderate_comments','upload_files' et 'edit_posts'
$editor->remove_cap('moderate_comments');
$editor->remove_cap('upload_files');
$editor->remove_cap('edit_posts');
// observez à nouveau et vous pouvez voir qu'elles n'y sont plus

// Maintenant nous allons choisir parmis les autres capabilities,pour ça j'ai regardé dans la liste de l'administrator une capabilitie que 'editor' n'avait pas et je lui ai rajouté. Vous pouvez décommenté la ligne ci-dessous et verifier.
// $editor->add_cap('switch_themes');
$variableVide =''; 

