<?php

namespace Anax\View;

?>

<main>
    <h1> Logga in </h1>
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
        </p>
        </fieldset>
    </form>

    <div>
        <?php if ($login === "yes" || $login === "admin") : ?>
            <p> Användare inloggad </p>
        <?php endif; ?>
    </div>
</main>
