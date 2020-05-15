<form method="post">
    <fieldset>
    <legend>Delete</legend>

    <input type="hidden" name="blogId" value="<?= esc($blog->id) ?>"/>

    <p>
        <label>Inlägg:<br>
            <input type="text" name="blogTitle" value="<?= esc($blog->title) ?>" readonly/>
        </label>
    </p>

    <p>
        <button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i>Radera</button>
    </p>
    </fieldset>
</form>
