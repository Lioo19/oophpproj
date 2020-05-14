<?php

namespace Anax\View;

?>

<main>
    <h1> Registrera dig </h1>
    <form method="post">
        <fieldset>
        <legend>Skapa ny användare</legend>

        <p>
            <label>Användarnamn<br>
                <input type="text" name="user" value="" required>
            </label>
        </p>

        <p>
            <label>Lösenord<br>
                <input type="password" name="password" value="" required>
            </label>
        </p>
        <p>
            <input type="submit" name="register" value="Registrera Dig">
        </p>
        <p>
            <a href="<?= url("login") ?>">Tillbaka</a>
        </p>
        </fieldset>
    </form>
</main>
