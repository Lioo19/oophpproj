<?php

namespace Anax\View;

if (!$res) {
    return;
}
?>

<article>
    <section class="blogheader">
        <h1> Bloggen! </h1>
        <p><strong> Välkommen in i spelens värld.<br> Här kommer vi att recensera spel varje vecka för att guida dig vidare bland denna djungel av brädspel. </strong></p>
    </section>
<?php foreach ($res as $row) : ?>
    <!-- <?php var_dump($row->image); ?> -->
<section class="blogsection">
        <!-- <?php print_r($row->slug) ?> -->
        <!-- <?php if ($row->path) : ?> -->
            <!-- <h1><a href="<?= url("blog/blogpost?slug=")?><?= esc($row->slug) ?>"><?= esc($row->title) ?></a></h1> -->
            <!-- <h1><a href="?route=blog/<?= esc($row->slug) ?>"><?= esc($row->title) ?></a></h1> -->
        <!-- <?php endif; ?> -->
    <?php if ($row->path) : ?>
        <img class="blogstart" src="./<?= $row->image ?>">
        <div class="blogfronttext">
            <h1><a href="<?= url("blog/blogpost?slug=")?><?= esc($row->slug) ?>"><?= esc($row->title) ?></a></h1>
            <?= substr($row->data, 0, 150) ?>...
            <p><i>Published: <time datetime="<?= esc($row->published) ?>" pubdate><?= esc($row->published) ?></time></i></p>
        </div>
    <?php endif; ?>
</section>
<?php endforeach; ?>

</article>
