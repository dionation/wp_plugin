<table class="form-table">
  <tr>
    <th><?php _e("Temps de préparation"); ?></th>
    <td>
      <select name="rat_time_preparation" id="rat_time_preparation">
       <!-- On passe notre clef de $time_choisi à $time car on utilise une function compact dans RecipeDetailsMetabox qui elle génère une clef du même nom que la variable passée. -->
        <option value="<?php echo $time ?>"><?php echo $time ?></option>
        <option value="10-15">de 10 à 15min</option>
        <option value="15-30">de 15 à 30min</option>
        <option value="30-45">de 30 à 45min</option>
      </select>
    </td>
  </tr>
</table> 