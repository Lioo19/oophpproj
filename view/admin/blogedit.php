<form method="post">
    <fieldset>
    <legend>Edit</legend>
    <input type="hidden" name="blogId" value="<?= esc($blog->id) ?>"/>

    <!-- <?php print_r($blog);?> -->
    <p>
        <label>Title:<br>
        <input type="text" name="blogTitle" value="<?= esc($blog->title) ?>"/>
        </label>
    </p>

    <p>
        <label>Path:<br>
        <input type="text" name="blogPath" value="<?= esc($blog->path) ?>"/>
    </p>

    <p>
        <label>Slug:<br>
        <input type="text" name="blogSlug" value="<?= esc($blog->slug) ?>"/>
    </p>

    <p>
        <label>Text:<br>
        <textarea name="blogData"><?= esc($blog->data) ?></textarea>
     </p>

     <p>
         <label>Type:<br>
         <input type="text" name="blogType" value="<?= esc($blog->type) ?>"/>
     </p>

     <p>
         <label>Filter:<br>
         <input type="text" name="blogFilter" value="<?= esc($blog->filter) ?>"/>
     </p>

     <p>
         <label>Publish:<br>
         <input type="datetime" name="blogPublish" value="<?= esc($blog->published) ?>"/>
     </p>

    <p>
        <button type="submit" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        <button type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
    </p>
    </fieldset>
</form>
