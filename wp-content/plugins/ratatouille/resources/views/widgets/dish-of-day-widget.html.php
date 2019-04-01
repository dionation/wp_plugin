<?= $args['before_widget'] ?>
<div class="widget-wrapper">
<!-- On utilise les variables passées par le compact de notre method widget() ligne 32 dans DishOfTheDayWidget.php, on utilise ça sous condition qu'elle existe pour ne pas avoir d'erreur,si on essaie d'affiché le contenu d'une variable alors qu'elle est vide il va nous donné une erreur -->
  <?php if (!empty($instance['title'])) : ?>
  <?php echo $args['before_title'] .  $instance['title'] . $args['after_title'] ?>
  <?php endif; ?>


  <div class="textwidget">

  <?php 
  // Pareil on affiche si la variable n'est pas vide et en même temps on assaini ce qu'on récupère avec la method esc_html__
  // https://developer.wordpress.org/reference/functions/esc_html__/
  if (!empty($instance['text'])) : 
  echo esc_html__($instance['text']); 
  endif; 
  ?>

  </div>

</div>
<?= $args['after_widget'] ?>