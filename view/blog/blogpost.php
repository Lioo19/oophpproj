<!-- <pre>

    <?php var_dump($blog); ?>

</pre> -->

<article>
    <header>
        <p><a href="index">Tillbaka</a></p>

        <h1><?= esc($blog->title) ?></h1>
        <p><i>Published: <time datetime="<?= esc($blog->published) ?>" pubdate><?= esc($blog->published) ?></time></i></p>
    </header>
    <img class="blogpost" src="../<?= $blog->image ?>">
    <img class="blogpost" src="../<?= $blog->image2 ?>">
    <?= $blog->data ?>
</article>
<div>

</div>
