<?php ob_start();
?>

<form action="index.php?history" method="post">
    <input type="hidden" name="deleteAll" value="true" />
    <input type="submit" class="btn btn-outline-danger" value="Supprimer historique" />
</form>

<form action="index.php?history" method="post">
    <input type="submit" class="btn btn-outline-danger" value="Supprimer les historiques sélectionnés"/>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Type</th>
            <th scope="col">Début du visionnage</th>
            <th scope="col">Fin du visionnage</th>
            <th scope="col">Temps de visionnage</th>
            <th scope="col">Sélectionner</th>
        </tr>
        </thead>
        <tbody>
        <?php
            foreach ($histories as $history):
            ?>
                <tr>
                    <th scope="row"><?= $history['title'] ?></th>
                    <td><?= $history['type'] ?></td>
                    <td><?= $history['start_date'] ?></td>
                    <td><?= $history['finish_date'] ?></td>
                    <td><?= $history['watch_duration'] ?></td>
                    <td><input type="checkbox" name="id_array[]" value="<?= $history['id'] ?>"></td>
                </tr>
            <?php
            endforeach;
        ?>
        </tbody>
    </table>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
