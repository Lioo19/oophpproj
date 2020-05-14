<?php

namespace Anax\View;

?>

<h1>CRUD</h1>

<h4>Här kan du:</h4>
<p>
-Ändra informationen om befintliga spel<br>
-Radera en produkt<br>
-Lägga till en ny produkt</p>

<form method="post">
    <p>
        <label>Produkt:<br>
        <select name="id">
            <option value="">Spel</option>
            <?php foreach ($products as $product) : ?>
            <option value="<?= $product->id ?>"><?= $product->name ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    </p>

    <p>
        <input type="submit" class="button" name="add" value="Ny Produkt">
        <input type="submit" class="button" name="edit" value="Redigera">
        <input type="submit" class="button" name="delete" value="Radera">
    </p>
</form>
