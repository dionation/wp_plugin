<div class="wrap">
    <!-- nous utilisons la fonction get_admin_page_title() pour récupérer le titre de la page admin que l'on a défini lors de l'enregistrement -->
    <h1><?= get_admin_page_title(); ?></h1>
    <p>Ce formulaire vous permet de contacter vos clients pour leur réservation.</p>
    <form action="<?= get_admin_url() . '/?action=send-mail'; ?>" method="post">
        <table class="form-table">
            <tr>
                <th>e-mail</th>
                <td><input type="email" name="email" id="email"></td>
            </tr>
            <tr>
                <th>Nom</th>
                <td><input type="text" name="name" id="name"></td>
            </tr>
            <tr>
                <th>Prénom</th>
                <td><input type="text" name="firstname" id="firstname"></td>
            </tr>
            <tr>
                <th>Message</th>
                <td><textarea name="message" id="message" cols="30" rows="10"></textarea></td>
            </tr>
            <tr>
                <th></th>
                <td><button type="submit" class="button-primary">Envoyer</button></td>
            </tr>

        </table>
    </form>
</div>  

