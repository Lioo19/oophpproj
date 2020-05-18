<?php

namespace Anax\View;

?>

<main>
    <h1> Logga in </h1>
    <div>
        <?php if ($successNewUser) : ?>
            <p> Användare skapad! </p>
        <?php endif; ?>
    </div>
    <form method="post">
        <fieldset>
        <legend>Logga In</legend>

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
            <input type="submit" name="login" value="Logga in">
        </p>
        <p>
            <a href="<?= url("login/register") ?>">Registrera dig</a>
            <a href="<?= url("login/logout") ?>">Logga ut</a>
        </p>
        </fieldset>
    </form>

    <div>
        <?php if ($login === "yes") : ?>
            <p> Användare inloggad </p>
        <?php elseif ($login === "admin") : ?>
            <p> Användare med admin-rättigheter inloggad </p>
        <?php elseif ($login === "no") : ?>
            <p> Inloggning misslyckades </p>
        <?php endif; ?>
    </div>
</main>
