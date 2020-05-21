<?php

namespace Anax\View;

?>
<!-- <pre>

    <?php var_dump($blog); ?>

</pre> -->

<article class="blogpost">
    <header>
        <p><a class="backbutton" href=" <?= url("blog") ?> "> < Tillbaka</a></p>
    </header>
    <div class="blogpostimages">
        <img class="blogpost" src="../<?= $blog->image ?>">
        <img class="blogpost" src="../<?= $blog->image2 ?>">
    </div>
    <h1><?= esc($blog->title) ?></h1>
    <div class="blogtext">
        <?= $blog->data ?>
    </div>
    <p class="time"><i>Published: <time datetime="<?= esc($blog->published) ?>" pubdate><?= esc($blog->published) ?></time></i></p>
</article>
<div>

</div>
