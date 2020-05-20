<?php

namespace Anax\View;

?>

<!-- <pre>
    <?php print_r($product);?> </pre> -->
<article class="productdetail">
    <header>
        <h1><?= esc($product->name) ?></h1>
        <img class="productview" src="../<?= $product->image ?>">
    </header>
    <div>
        <?= $product->description ?>
    </div>
    <div class="proddata">
        <p><i>Tillverkare: <?= esc($product->brand) ?>, <?= esc($product->year) ?></i></p>
        <p><i>Språk: <?= esc($product->language) ?></i></p>
        <p><i>Antal Spelare: <?= esc($product->players) ?></i></p>
        <p><i>Speltid: <?= esc($product->time) ?></i></p>
        <p><i>Kategori: <?= esc($product->type) ?></i></p>
        <p><i>Betyg: <?= esc($product->rating) ?></i></p>
        <p><i>Lagersaldo: <?= esc($product->stock) ?></i></p>
        <p><b>Pris: <?= esc($product->price) ?> kr</b></p>
    </div>

</article>
