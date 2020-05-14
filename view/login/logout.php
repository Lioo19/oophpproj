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
                <input type="text" name="user" value=""/>
            </label>
        </p>

        <p>
            <label>Lösenord<br>
                <input type="password" name="password" value=""/>
            </label>
        </p>
        <p>
            <input type="submit" name="login" value="Logga in">
        </p>
        <p>
            <a href="<?= url("login/new") ?>">Registrera dig</a>
        </p>
        </fieldset>
    </form>
</main>
