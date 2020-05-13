<?php

namespace Anax\View;

?>

<form method="get">
    <fieldset class="productfield">
    <legend>Search</legend>
    <input type="hidden" name="route" value="search-name">
    <p>
        <label>Namn (use % as wildcard):
            <input type="search" name="searchName" value="<?= esc($searchName) ?>"/>
        </label>
    </p>
    <p>
        <input type="submit" name="search" value="Search">
    </p>
    <p><a class="productbutton" href="<?= url("product/search-name") ?>">Visa alla</a></p>
    </fieldset>
</form>
