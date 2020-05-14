<?php

namespace Anax\View;

/**
 * Template file to render a view with content.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
if (!$res) {
    return;
}

?>
<!-- <pre>
<?php print_r($data); ?>
</pre> -->
<table>
    <tr class="first">
        <!-- <th>Id</th> -->
        <th>Bild</th>
        <th>Namn</th>
        <th>Pris</th>
        <th>Saldo</th>
        <th>Tillverkare</th>
        <th>Speltid</th>
        <th>Antal spelare</th>
        <th>År</th>
        <th>Språk</th>
        <!-- <th>Beskrivning</th> -->
        <th>Kategori</th>
        <th>Betyg</th>
    </tr>
<?php $id = -1; foreach ($res as $row) :
    $id++; ?>
    <tr>
        <!-- <td><?= $row->id ?></td> -->
        <?php if ($check) : ?>
            <td><img class="thumb" src="../<?= $row->image ?>"></td>
        <?php else : ?>
            <td><img class="thumb" src="./<?= $row->image ?>"></td>
        <?php endif; ?>
        <!-- <?php var_dump($row->image); ?> -->
        <td><?= $row->name ?></td>
        <td><?= $row->price ?></td>
        <td><?= $row->stock ?></td>
        <td><?= $row->brand ?></td>
        <td><?= $row->time ?></td>
        <td><?= $row->players ?></td>
        <td><?= $row->year ?></td>
        <td><?= $row->language ?></td>
        <!-- <td><?= $row->description ?></td> -->
        <td><?= $row->type ?></td>
        <td><?= $row->rating ?></td>
    </tr>
<?php endforeach; ?>
</table>
