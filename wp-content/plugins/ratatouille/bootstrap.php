<?php
// J'ai copié collé(mis à part require autoload) le contenu de ratatouille.php ici même.
use App\Features\PostTypes\RecipePostType as RecipePostType;
use App\Features\Taxonomies\RecipeTaxonomy;
use App\Features\MetaBoxes\RecipeDetailsMetabox;

require_once('env.php');

require_once('helpers.php');

add_action('init',[RecipePostType::class, 'register']);

add_action('init', [RecipeTaxonomy::class, 'register']);

add_action('add_meta_boxes_recipe', [RecipeDetailsMetabox::class, 'add_meta_box']); 

add_action('save_post_' . RecipePostType::$slug, [RecipeDetailsMetabox::class, 'save']);