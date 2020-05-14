<?php

namespace Anax\View;

?>

<!-- <pre>
    <?php print_r($product);?> </pre> -->
<article>
    <header>
        <h1><?= esc($product->name) ?></h1>
        <h2> Lägg in någon sorts detaljkort-vy??</h2>
        <img class="productview" src="../<?= $product->image ?>">
    </header>
    <div>
        <?= $product->description ?>
    </div>
    <div>
        <p><i>Tillverkare: <?= esc($product->brand) ?>, <?= esc($product->year) ?></i></p>
        <p><i>Språk: <?= esc($product->language) ?></i></p>
        <p><i>Antal Spelare: <?= esc($product->players) ?></i></p>
        <p><i>Speltid: <?= esc($product->time) ?></i></p>
        <p><i>Kategori: <?= esc($product->type) ?></i></p>
        <p><i>Betyg: <?= esc($product->rating) ?></i></p>
        <p><i>Lagersaldo: <?= esc($product->stock) ?></i></p>
        <p><b> <?= esc($product->price) ?></b></p>
    </div>

</article>
