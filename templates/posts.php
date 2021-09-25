<?php

use app\core\Application;

$this->layout('layouts/main') ?>

<?php
$limit = 15;
if (isset($_GET['start'])) {
    $start = $_GET['start'];
} else {
    $start = 0;
}
if ($start % $limit !== 0) {
    header('Location: /cms2/');
}
/*var_dump($title);
exit;

use app\controller\ContentController;
use app\core\Application;

$this->title = "Post"; // this should be post title
$path = $_SERVER['REQUEST_URI'];
$title = substr($path, 5);
$thePost = [];
$contentController = new ContentController();
/*foreach ($contentController->getContents() as $content) {
    if (html_entity_decode(Application::slugify($content['title'])) === $title) {
        $thePost = $content;
    }
}*/

?>
<!-- s-content
    ================================================== -->
    <h1><?=$categoryname?></h1>
   
    <section class="s-content">
    <div class="row masonry-wrap">
        <div class="masonry">
            <div class="grid-sizer"></div>
            <?php foreach ($posts as $content) : ?>
                <?php /*if ($content['active']) :*/ ?>
                <article class="masonry__brick entry format-standard" data-aos="fade-up">

                    <div class="entry__thumb">
                        <a href="/cms2/post/<?php $content['id'] ?>" class="entry__thumb-link">
                            <img src="<?= PUBLIC_PATH ?>/uploads/<?php echo $content['image'] ?>">
                        </a>
                    </div>

                    <div class="entry__text">
                        <div class="entry__header">

                            <div class="entry__date">
                                <a href="/cms2/post/<?php echo $content['id'] ?>"><?php echo $content['updated_at'] ?></a>
                            </div>
                            <h1 class="entry__title"><a href="/cms2/post/<?php echo $content['id'] ?>"><?php echo $content['title'] ?></a></h1>

                        </div>
                        <!-- <div class="entry__excerpt"> -->
                        <?php /*echo html_entity_decode($content['content'], ENT_HTML5)*/ ?>

                        <!-- </div> -->
                        <div class="entry__meta">
                            <span class="entry__meta-links">
                                <a href="/cms2/categories/<?php echo strtolower(Application::slugify($content['category'])) ?>"><?php echo $content['category'] ?></a>
                            </span>
                        </div>
                    </div>

                </article> <!-- end article -->
                <?php /*endif;*/ ?>
            <?php endforeach; ?>
        </div> <!-- end masonry -->
    </div> <!-- end masonry-wrap -->

    <div class="row">
        <div class="col-full">
            <nav class="pgn">
                <ul>
                    <?php if ($start > 0) : ?>
                        <li><a class="pgn__prev" href="/cms2/?start= <?php echo ($start - $limit) ?>">Prev</a></li>
                    <?php endif; ?>
                    <?php if (count($posts) > ($start + $limit)) : ?>
                        <li><a class="pgn__next" href="/cms2/?start=<?php echo ($start + $limit) ?>">Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>

</section> <!-- s-content -->