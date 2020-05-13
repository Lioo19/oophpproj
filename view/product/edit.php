<?php

namespace Anax\View;

?>

<form method="post">
    <fieldset>
    <legend>Ändra</legend>
    <input type="hidden" name="id" value="<?= $product->id ?>"/>

    <p>
        <label>Namn:<br>
            <input type="text" name="name" value="<?= $product->name ?>"/>
        </label>
    </p>

    <p>
        <label>Pris:<br>
            <input type="number" name="price" value="<?= $product->price ?>"/>
        </label>
    </p>

    <p>
        <label>Saldo:<br>
            <input type="number" name="stock" value="<?= $product->stock ?>"/>
        </label>
    </p>

    <p>
        <label>Tillverkare:<br>
            <input type="text" name="brand" value="<?= $product->brand ?>"/>
        </label>
    </p>

    <p>
        <label>Speltid:<br>
            <input type="text" name="time" value="<?= $product->time ?>"/>
        </label>
    </p>

    <p>
        <label>Antal spelare:<br>
            <input type="text" name="players" value="<?= $product->players ?>"/>
        </label>
    </p>

    <p>
        <label>År:<br>
            <input type="text" name="year" value="<?= $product->year ?>"/>
        </label>
    </p>

    <p>
        <label>Språk:<br>
            <input type="text" name="language" value="<?= $product->language ?>"/>
        </label>
    </p>

    <p>
        <label>Beskrivning:<br>
            <p> <?= $product->description ?></p>
            <input type="text" name="description" value="<?= $product->description ?>"/>
        </label>
    </p>

    <p>
        <label>Kategori:<br>
            <input type="text" name="type" value="<?= $product->type ?>"/>
        </label>
    </p>

    <p>
        <label>Betyg:<br>
            <input type="text" name="rating" value="<?= $product->rating ?>"/>
        </label>
    </p>

    <p>
        <label>Bild:<br>
            <input type="text" name="image" value="<?= $product->image ?>"/>
        </label>
    </p>

    <p>
        <input type="submit" name="save" value="Spara">
    </p>
    <p>
        <a href="<?= url("product/select") ?>">Välj Produkt</a> |
        <a href="<?= url("product/show-all") ?>">Visa Alla</a>
    </p>
    </fieldset>
</form>
