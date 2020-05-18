<?php

if (!$products) {
    return;
}
?>

<!-- <pre>
    <?php print_r($products); ?>
</pre> -->

<table>
    <tr class="first">
        <th>Bild</th>
        <th>Namn</th>
        <th>Pris</th>
        <th>Saldo</th>
        <th>Speltid</th>
        <th>Spelare</th>
        <th>År</th>
        <th>Beskrivning</th>
        <th>Kategori</th>
        <th>Betyg</th>
        <th>Hantera</th>
    </tr>
<?php foreach ($products as $product) : ?>
    <tr>
        <td><img class="thumb" src="../<?= $product->image ?>"></td>
        <td><?= $product->name ?></td>
        <td><?= $product->price ?></td>
        <td><?= $product->stock ?></td>
        <td><?= $product->time ?></td>
        <td><?= $product->players ?></td>
        <td><?= $product->year ?></td>
        <td><?= substr($product->description, 0, 99) ?>...</td>
        <td><?= $product->type ?></td>
        <td><?= $product->rating ?></td>
        <td>
            <a href="productedit?id=<?= esc($product->id) ?>" title="Edit this product">
                <i class="fa fa-pencil-square-o" aria-hidden="true">Edit</i>
            </a> /
            <a href="productdelete?id=<?= $product->id ?>" title="Delete this product">
                <i class="fa fa-trash-o" aria-hidden="true">Delete</i>
            </a>
        </td>
    </tr>
<?php endforeach; ?>
</table>
