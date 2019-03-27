<?php 
use App\Features\PostTypes\RecipePostType as RecipePostType;
use App\Features\Taxonomies\RecipeTaxonomy;
use App\Features\MetaBoxes\RecipeDetailsMetabox;
use App\Features\Widgets\DishOfTheDayWidget;

add_action('init',[RecipePostType::class, 'register']);

add_action('init', [RecipeTaxonomy::class, 'register']);

add_action('add_meta_boxes_recipe', [RecipeDetailsMetabox::class, 'add_meta_box']); 

add_action('save_post_' . RecipePostType::$slug, [RecipeDetailsMetabox::class, 'save']);

add_action('widgets_init', [DishOfTheDayWidget::class, 'register']);