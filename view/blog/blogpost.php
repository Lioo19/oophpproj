<article>
    <header>
        <p><a href="index">Tillbaka</a></p>

        <h1><?= esc($blog->title) ?></h1>
        <p><i>Published: <time datetime="<?= esc($blog->published_iso8601) ?>" pubdate><?= esc($blog->published) ?></time></i></p>
    </header>
    <?= $blog->data ?>
</article>
<div>

</div>
