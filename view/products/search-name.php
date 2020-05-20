<?php

namespace Anax\View;

?>

<form method="get">
    <fieldset class="productfield">
    <legend>Sök på spel</legend>
    <input type="hidden" name="route" value="search-name">
    <p>
        <label>Namn (använd % för att söka på delar av ord, ex S% för spel som börjar på S):
            <br>
            <input class="productsearch" type="search" name="searchName" value="<?= esc($searchName) ?>"/>
        </label>
    </p>
    <p>
        <input type="submit" name="search" value="Sök">
    </p>
    <p><a class="productbutton" href="<?= url("products/search-name") ?>">Visa alla</a></p>
    </fieldset>
</form>
