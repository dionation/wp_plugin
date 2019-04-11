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
            <?php foreach ($mails as $mail) : ?>
            <div class="postbox">
                <div class="inside">
                    <strong>client : </strong><?= $mail->email; ?>
                    <!-- On entour notre bouton 'voir' de ce qu'on appel un 'Gate' c'est une façon de cacher un élément si on à pas la permission,la page que rendais le bouton 'voir' est toujours accessible si on connait l'url mais le bouton lui est maintenant caché -->
                    <!-- A vous de changer le mot "permission" dans notre function curent_user_can par la permission 'show_email' et de voir la différence -->
                    <?php if (current_user_can('show_email')) : ?>
                    <a href="<?php menu_page_url('mail-client'); ?>&action=show&id=<?= $mail->id; ?>" class="button-primary">voir</a>
                    <?php endif; ?>
                </div>
            </div>            
            <?php endforeach; ?>
        </div>
    </div>
</div>