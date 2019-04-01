<p>
    <label for="title"><?php esc_attr_e('Title:', 'text_domain'); ?></label>
    <!-- On utilise les variables title et text pour les affichées dans notre vue et pour cela on les mets dans value pour l'input et entre les balises pour textarea. -->
    <input class="widefat" id="title" name="<?php echo $title_name; ?>" type="text" value="<?= $title ?>">
</p>
<p>
    <textarea class="widefat" id="text" name="<?php echo $text_name ; ?>" type="text" cols="30" rows="10"><?= $text ?></textarea>
</p> 