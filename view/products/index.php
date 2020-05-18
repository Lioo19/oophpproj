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
<div class="productfront">
    <h2> Spel </h2>
    <?php $id = -1; foreach ($res as $row) :
        $id++; ?>
        <div>
            <?php if ($check) : ?>
                <a href="products/product?id=<?= esc($row->id) ?>">
                    <figure class="productcard">
                        <h5> <?= esc($row->name) ?> </h5>
                        <img class="thumb" src="../<?= $row->image ?>">
                        <p> <?= esc($row->price) ?> kr</p>
                    </figure>
                </a>
            <?php else : ?>
                <a href="products/product?id=<?= esc($row->id) ?>">
                    <figure class="productcard">
                        <h5> <?= esc($row->name) ?> </h5>
                        <img class="thumb" src="./<?= $row->image ?>">
                        <p> <?= esc($row->price) ?> kr</p>
                    </figure>
                </a>
            <?php endif; ?>
    <?php endforeach; ?>
</div>
