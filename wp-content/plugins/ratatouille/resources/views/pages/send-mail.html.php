<div class="wrap">
    <!-- nous utilisons la fonction get_admin_page_title() pour récupérer le titre de la page admin que l'on a défini lors de l'enregistrement -->
    <h1><?= get_admin_page_title(); ?></h1>
    <!-- Ici nous ajoutons une partie d'html qui prendra en charge les notifications. On met cela dans un fichier à part afin de pouvoir réutiliser les notifications ailleurs -->
    <?php view('partials/notice'); ?>
    <div class="row">
        <div class="col-sm-6">

            <p>Ce formulaire vous permet de contacter vos clients pour leur réservation.</p>
            <form action="<?= get_admin_url() . '?action=send-mail'; ?>" method="post">
                <!-- Cette fonction créer des inputs cachés qui contiennent des informations qui vont nous permetre de savoir si le formulaire est authentique et si il est bien executé via notre site web et pas via une autre source. -->
                <?php wp_nonce_field('send-mail'); ?>

                <table class="form-table">
                    <tr>
                        <th>e-mail</th>
                        <!-- Lorsqu'on affiche le formulaire sans être passé par les validations aucune clé old na été enregistré dans la sessions, ceci créer une erreur si l'on demande de l'affichée,c'est pour cela que l'on met une condition,on demande de l'affichée que si elle existe -->
                        <td><input type="email" name="email" id="email"
                                value="<?= isset($old['email']) ? $old['email'] : '' ?>"></td>
                    </tr>
                    <tr>
                        <th>Nom</th>
                        <td><input type="text" name="name" id="name"
                                value="<?= isset($old['name']) ? $old['name'] : '' ?>"></td>
                    </tr>
                    <tr>
                        <th>Prénom</th>
                        <td><input type="text" name="firstname" id="firstname"
                                value="<?= isset($old['firstname']) ? $old['firstname'] : '' ?>"></td>
                    </tr>
                    <tr>
                        <th>Message</th>
                        <td><textarea name="message" id="message" cols="30"
                                rows="10"><?= isset($old['message']) ? $old['message'] : '' ?></textarea></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td><button type="submit" class="button-primary">Envoyer</button></td>
                    </tr>

                </table>
            </form>
        </div>
        <div class="col-sm-6">
         <!-- on reçois la variable mails(celle qu'on a compact dans la commit précedent) c'est une variable qui contient un tableau contenant chaque mails enregistré dans la Base de donnée(bdd), on va donc faire un foreach et créer une div class postbox pour chaque élément à fin d'avoir un rendu correct. -->
            <?php foreach ($mails as $mail) : ?>
            <div class="postbox">
                <div class="inside">
                    <strong>client : </strong><?= $mail->email; ?>
                </div>
            </div>            
            <?php endforeach; ?>
        </div>
    </div>
</div>