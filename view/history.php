<?php ob_start(); ?>

<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Titre</th>
        <th scope="col">Type</th>
        <th scope="col">Début du visionnage</th>
        <th scope="col">Fin du visionnage</th>
        <th scope="col">Temps de visionnage</th>
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
    </tr>
    <?php
    endforeach;
    ?>

    </tbody>
</table>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
