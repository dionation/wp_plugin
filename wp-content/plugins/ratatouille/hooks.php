<?php 
use App\Features\PostTypes\RecipePostType as RecipePostType;
use App\Features\Taxonomies\RecipeTaxonomy;
use App\Features\MetaBoxes\RecipeDetailsMetabox;
use App\Features\Widgets\DishOfTheDayWidget;
use App\Features\Sections\Section;
use App\Features\Pages\Page;
use App\Http\Controllers\MailController;
use App\Setup;
use App\Database\Database;
add_action('init',[RecipePostType::class, 'register']);
add_action('init', [RecipeTaxonomy::class, 'register']);
add_action('add_meta_boxes_recipe', [RecipeDetailsMetabox::class, 'add_meta_box']); 
add_action('save_post_' . RecipePostType::$slug, [RecipeDetailsMetabox::class, 'save']);
add_action('widgets_init', [DishOfTheDayWidget::class, 'register']);
add_action('admin_init',[Section::class,'init']);
add_action('admin_menu',[Page::class,'init']);
add_action('admin_action_send-mail', [MailController::class, 'send']);
add_action('admin_init', [Setup::class, 'start_session']);
// On ajoute la méthode qui va s'executer lors de l'activation du plugin
// Cette fonction ne s'active que lors de l'activation du plugin https://developer.wordpress.org/reference/functions/register_activation_hook/
register_activation_hook(__DIR__ . '/ratatouille.php', [Database::class, 'init']);