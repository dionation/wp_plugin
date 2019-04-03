<?php 
use App\Features\PostTypes\RecipePostType as RecipePostType;
use App\Features\Taxonomies\RecipeTaxonomy;
use App\Features\MetaBoxes\RecipeDetailsMetabox;
use App\Features\Widgets\DishOfTheDayWidget;
use App\Features\Sections\Section;
use App\Features\Pages\Page;
use App\Features\Pages\SendMail;


add_action('init',[RecipePostType::class, 'register']);
add_action('init', [RecipeTaxonomy::class, 'register']);
add_action('add_meta_boxes_recipe', [RecipeDetailsMetabox::class, 'add_meta_box']); 
add_action('save_post_' . RecipePostType::$slug, [RecipeDetailsMetabox::class, 'save']);
add_action('widgets_init', [DishOfTheDayWidget::class, 'register']);
add_action('admin_init',[Section::class,'init']);
add_action('admin_menu',[Page::class,'init']);

add_action('admin_action_send-mail', [SendMail::class, 'send_mail']);