<?php 
// J'ai copié collé tous les add_action de bootstrap.php et j'ai fait un appel de ce fichier(hooks.php) dans bootstrap.php à la place
use App\Features\PostTypes\RecipePostType as RecipePostType;
use App\Features\Taxonomies\RecipeTaxonomy;
use App\Features\MetaBoxes\RecipeDetailsMetabox;

add_action('init',[RecipePostType::class, 'register']);

add_action('init', [RecipeTaxonomy::class, 'register']);

add_action('add_meta_boxes_recipe', [RecipeDetailsMetabox::class, 'add_meta_box']); 

add_action('save_post_' . RecipePostType::$slug, [RecipeDetailsMetabox::class, 'save']);