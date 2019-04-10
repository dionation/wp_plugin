<div class="wrap">
    <!-- nous utilisons la fonction get_admin_page_title() pour récupérer le titre de la page admin que l'on a défini lors de l'enregistrement -->
    <h1><?= get_admin_page_title(); ?>: </h1>

    <!-- Ici nous ajoutons une partie d'html afin qui prendra en charge les notifications. On met cela dans un fichier à part afin de pouvoir réutiliser les notifications ailleurs -->
    <?php view('partials/notice'); ?>
    <div class="row">
        <div class="col-sm-6">
            <div class="postbox">
                <div class="inside">
                    <form action="<?php get_site_url(); ?>?action=mail-update" method="post">
                    <!-- On rajout un nonce qui nous servira à vérifier que le formulaire est authentique -->
                    <?php wp_nonce_field('edit-mail'); ?>
                    <!-- On ajout un input contenant l'id du mail qu'on récupérera dans $_POST pour savoir quel email mettre à jours dans la BDD -->
                    <input type="hidden" name="id" value="<?= $mail->id; ?>">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $mail->email; ?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Nom</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $mail->lastname; ?>">
                        </div>
                        <div class="form-group">
                            <label for="firstname">Password</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $mail->firstname; ?>">
                        </div>
                        <div class="form-group">
                            <label for="content">Message</label>
                            <textarea class="form-control" name="content" id="content" rows="3"><?= $mail->content; ?></textarea>
                        </div>
                        <a href="<?php menu_page_url('mail-client'); ?>&action=show&id=<?= $mail->id; ?>" class="button button-primary">retour</a>
                        <button type="submit" class="button">enregistrer</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</div>