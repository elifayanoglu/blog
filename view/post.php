<?php
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
<section class="s-content s-content--narrow s-content--no-padding-bottom">

    <article class="row format-gallery">

        <div class="s-content__header col-full">
            <h1 class="s-content__header-title">
                <?php echo $thePost['title'] ?>
            </h1>
            <ul class="s-content__header-meta">
                <li class="date"><?php echo $thePost['updated_at'] ?></li>
                <li class="cat">
                    In
                    <a href="/cms/categories/<?php echo $thePost['category'] ?>"><?php echo $thePost['category'] ?></a>
                </li>
            </ul>
        </div> <!-- end s-content__header -->

        <div class="s-content__media col-full">
            
            <img src="<?php echo PUBLIC_PATH ?>/uploads/<?php echo $thePost['image']?>" alt="">
        </div> <!-- end s-content__media -->

        <div class="col-full s-content__main">

            <?php echo html_entity_decode($thePost['content'])?>

            <hr>
            <div class="s-content__author" style="padding: 0px; margin: 0px;">
                <!-- <img src="images/avatars/user-03.jpg" alt=""> -->

                <div class="s-content__author-about">
                    <h4 class="s-content__author-name">
                        <a href="/cms/about">Ali Bingül (Author)</a>
                    </h4>

                    <ul class="s-content__author-social">
                        <li><a href="https://www.linkedin.com/in/alibingul/" target="_blank">Linkedin</a></li>
                    </ul>
                </div>
            </div>

            <div class="s-content__pagenav">
                <div class="s-content__nav">
                    <div class="s-content__prev">
                        <a href="#0" rel="prev">
                            <span>Previous Post</span>
                            Tips on Minimalist Design
                        </a>
                    </div>
                    <div class="s-content__next">
                        <a href="#0" rel="next">
                            <span>Next Post</span>
                            Less Is More
                        </a>
                    </div>
                </div>
            </div> <!-- end s-content__pagenav -->

        </div> <!-- end s-content__main -->

    </article>


    <!-- comments
        ================================================== -->
    <div class="comments-wrap">

        <div id="comments" class="row">
            <div class="col-full">

                <h3 class="h2">5 Comments</h3>

                <!-- commentlist -->
                <ol class="commentlist">

                    <li class="depth-1 comment">

                        <div class="comment__avatar">
                            <img width="50" height="50" class="avatar" src="images/avatars/user-01.jpg" alt="">
                        </div>

                        <div class="comment__content">

                            <div class="comment__info">
                                <cite>Itachi Uchiha</cite>

                                <div class="comment__meta">
                                    <time class="comment__time">Dec 16, 2017 @ 23:05</time>
                                    <a class="reply" href="#0">Reply</a>
                                </div>
                            </div>

                            <div class="comment__text">
                                <p>Adhuc quaerendum est ne, vis ut harum tantas noluisse, id suas iisque mei. Nec te inani ponderum vulputate,
                                    facilisi expetenda has et. Iudico dictas scriptorem an vim, ei alia mentitum est, ne has voluptua praesent.</p>
                            </div>

                        </div>

                    </li> <!-- end comment level 1 -->

                    <li class="thread-alt depth-1 comment">

                        <div class="comment__avatar">
                            <img width="50" height="50" class="avatar" src="images/avatars/user-04.jpg" alt="">
                        </div>

                        <div class="comment__content">

                            <div class="comment__info">
                                <cite>John Doe</cite>

                                <div class="comment__meta">
                                    <time class="comment__time">Dec 16, 2017 @ 24:05</time>
                                    <a class="reply" href="#0">Reply</a>
                                </div>
                            </div>

                            <div class="comment__text">
                                <p>Sumo euismod dissentiunt ne sit, ad eos iudico qualisque adversarium, tota falli et mei. Esse euismod
                                    urbanitas ut sed, et duo scaevola pericula splendide. Primis veritus contentiones nec ad, nec et
                                    tantas semper delicatissimi.</p>
                            </div>

                        </div>

                        <ul class="children">

                            <li class="depth-2 comment">

                                <div class="comment__avatar">
                                    <img width="50" height="50" class="avatar" src="images/avatars/user-03.jpg" alt="">
                                </div>

                                <div class="comment__content">

                                    <div class="comment__info">
                                        <cite>Kakashi Hatake</cite>

                                        <div class="comment__meta">
                                            <time class="comment__time">Dec 16, 2017 @ 25:05</time>
                                            <a class="reply" href="#0">Reply</a>
                                        </div>
                                    </div>

                                    <div class="comment__text">
                                        <p>Duis sed odio sit amet nibh vulputate
                                            cursus a sit amet mauris. Morbi accumsan ipsum velit. Duis sed odio sit amet nibh vulputate
                                            cursus a sit amet mauris</p>
                                    </div>

                                </div>

                                <ul class="children">

                                    <li class="depth-3 comment">

                                        <div class="comment__avatar">
                                            <img width="50" height="50" class="avatar" src="images/avatars/user-04.jpg" alt="">
                                        </div>

                                        <div class="comment__content">

                                            <div class="comment__info">
                                                <cite>John Doe</cite>

                                                <div class="comment__meta">
                                                    <time class="comment__time">Dec 16, 2017 @ 25:15</time>
                                                    <a class="reply" href="#0">Reply</a>
                                                </div>
                                            </div>

                                            <div class="comment__text">
                                                <p>Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est
                                                    etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum.</p>
                                            </div>

                                        </div>

                                    </li>

                                </ul>

                            </li>

                        </ul>

                    </li> <!-- end comment level 1 -->

                    <li class="depth-1 comment">

                        <div class="comment__avatar">
                            <img width="50" height="50" class="avatar" src="images/avatars/user-02.jpg" alt="">
                        </div>

                        <div class="comment__content">

                            <div class="comment__info">
                                <cite>Shikamaru Nara</cite>

                                <div class="comment__meta">
                                    <time class="comment-time">Dec 16, 2017 @ 25:15</time>
                                    <a class="reply" href="#">Reply</a>
                                </div>
                            </div>

                            <div class="comment__text">
                                <p>Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem.</p>
                            </div>

                        </div>

                    </li> <!-- end comment level 1 -->

                </ol> <!-- end commentlist -->


                <!-- respond
                    ================================================== -->
                <div class="respond">

                    <h3 class="h2">Add Comment</h3>

                    <form name="contactForm" id="contactForm" method="post" action="">
                        <fieldset>

                            <div class="form-field">
                                <input name="cName" type="text" id="cName" class="full-width" placeholder="Your Name" value="">
                            </div>

                            <div class="form-field">
                                <input name="cEmail" type="text" id="cEmail" class="full-width" placeholder="Your Email" value="">
                            </div>

                            <div class="form-field">
                                <input name="cWebsite" type="text" id="cWebsite" class="full-width" placeholder="Website" value="">
                            </div>

                            <div class="message form-field">
                                <textarea name="cMessage" id="cMessage" class="full-width" placeholder="Your Message"></textarea>
                            </div>

                            <button type="submit" class="submit btn--primary btn--large full-width">Submit</button>

                        </fieldset>
                    </form> <!-- end form -->

                </div> <!-- end respond -->

            </div> <!-- end col-full -->

        </div> <!-- end row comments -->
    </div> <!-- end comments-wrap -->

</section> <!-- s-content -->