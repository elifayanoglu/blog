<?php $this->layout('layouts/main') ?>
<?php

use app\controller\ContentController;
use app\core\Application;

$contentController = new ContentController();
?>

<!-- s-content
    ================================================== -->
<section class="s-content">
    <h1><?=$name?></h1>
    <div class="row masonry-wrap">
        <div class="masonry">
            <div class="grid-sizer"></div>
            <?php foreach ($contentController->getContents() as $content) : ?>
                <?php if ($content['active']) : ?>
                    <article class="masonry__brick entry format-standard" data-aos="fade-up">

                        <div class="entry__thumb">
                            <a href="/cms/<?php echo html_entity_decode(Application::slugify($content['title']), ENT_HTML5) ?>" class="entry__thumb-link">
                                <img src="<?= PUBLIC_PATH ?>/uploads/<?php echo $content['image'] ?>">
                            </a>
                        </div>

                        <div class="entry__text">
                            <div class="entry__header">

                                <div class="entry__date">
                                    <a href="/cms/<?php echo html_entity_decode(Application::slugify($content['title']), ENT_HTML5) ?>"><?php echo $content['updated_at'] ?></a>
                                </div>
                                <h1 class="entry__title"><a href="/cms/<?php echo html_entity_decode(Application::slugify($content['title']), ENT_HTML5) ?>"><?php echo $content['title'] ?></a></h1>

                            </div>
                            <!-- <div class="entry__excerpt"> -->
                                <?php /*echo html_entity_decode($content['content'], ENT_HTML5)*/ ?>
                                
                            <!-- </div> -->
                            <div class="entry__meta">
                                <span class="entry__meta-links">
                                    <a href="/cms/categories/<?php echo Application::slugify($content['category']) ?>"><?php echo $content['category'] ?></a>
                                </span>
                            </div>
                        </div>

                    </article> <!-- end article -->
                <?php endif; ?>
            <?php endforeach; ?>
        </div> <!-- end masonry -->
    </div> <!-- end masonry-wrap -->

    <div class="row">
        <div class="col-full">
            <nav class="pgn">
                <ul>
                    <li><a class="pgn__prev" href="#0">Prev</a></li>
                    <li><a class="pgn__num" href="#0">1</a></li>
                    <li><span class="pgn__num current">2</span></li>
                    <li><a class="pgn__num" href="#0">3</a></li>
                    <li><a class="pgn__num" href="#0">4</a></li>
                    <li><a class="pgn__num" href="#0">5</a></li>
                    <li><span class="pgn__num dots">…</span></li>
                    <li><a class="pgn__num" href="#0">8</a></li>
                    <li><a class="pgn__next" href="#0">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>

</section> <!-- s-content -->

<script>
    let contentWrappers = document.getElementsByClassName("entry__excerpt");
</script>