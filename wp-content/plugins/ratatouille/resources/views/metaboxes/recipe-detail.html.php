<table class="form-table">
  <tr>
    <th><?php _e("Temps de préparation"); ?></th>
    <td>
      <select name="rat_time_preparation" id="rat_time_preparation">
        <!-- Maintenant que le tableau à été traité et renvoyé dans cette vue on peut se servir de la clef devant la quelle on rajout un "$" pour récupérer la valeur qui lui à été attribuée. -->
        <option value=""><?php echo $time_choisi ?></option>
        <option value="10-15">de 10 à 15min</option>
        <option value="15-30">de 15 à 30min</option>
        <option value="30-45">de 30 à 45min</option>
      </select>
    </td>
  </tr>
</table> 