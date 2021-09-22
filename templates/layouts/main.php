<?php

use app\controller\CategoryController;
use app\controller\MemberController;
use app\core\Application;
use app\Services\MemberService;
use app\Services\CategoryService;

$categoryController = new CategoryService();
$memberController = new MemberService();
?>


<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title><?=$title?></title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="<?= PUBLIC_PATH ?>/philosophy/css/base.css">
    <link rel="stylesheet" href="<?= PUBLIC_PATH ?>/philosophy/css/vendor.css">
    <link rel="stylesheet" href="<?= PUBLIC_PATH ?>/philosophy/css/main.css">

    <!-- script
    ================================================== -->
    <script src="<?= PUBLIC_PATH ?>/philosophy/js/modernizr.js"></script>
    <script src="<?= PUBLIC_PATH ?>/philosophy/js/pace.min.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="<?= PUBLIC_PATH ?>/philosophy/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= PUBLIC_PATH ?>/philosophy/favicon.ico" type="image/x-icon">

    <style>
        .s-pageheader--home {
            min-height: 170px;
        }
    </style>

</head>

<body id="top">

    <!-- pageheader
    ================================================== -->
    <section class="s-pageheader s-pageheader--home">

        <header class="header">
            <div class="header__content row">

                <div class="header__logo">
                    <a class="logo" href="/cms2/">
                        <img src="<?= PUBLIC_PATH ?>/philosophy/images/logo.svg" alt="Homepage">
                    </a>
                </div> <!-- end header__logo -->

                <ul class="header__social">
                    <li>
                        <a href="https://www.linkedin.com/in/elifayanoglu/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    </li>
                    <!-- <li>
                        <a href="#0"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#0"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#0"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                    </li> -->
                </ul> <!-- end header__social -->

                   <?php if (Application::isGuest()) : ?> 
                    <div style="display:flex; justify-content:flex-end;">
                        <a href="/cms2/login" style="color: white;">Login</a>
                    </div>
                    <div style="display:flex; justify-content:flex-end;">
                        <a href="/cms2/register" style="color: white;">Register</a>
                    </div>
                <?php else : ?>
                    <div style="display:flex; justify-content:flex-end;">
                        <a href="/cms2/logout" style="color: white;"><?php echo /*Application::$app->member->getDisplayName();*/ $memberController->getMember(['id' => $_SESSION['member']])->username ?>
                            (Logout)
                        </a>
                    </div>
                <?php endif; ?>

                <a class="header__search-trigger" href="#0"></a>
                <div class="header__search">
                    <form role="search" method="get" class="header__search-form" action="#">
                        <label>
                            <span class="hide-content">Search for:</span>
                            <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="Search for:" autocomplete="off">
                        </label>
                        <input type="submit" class="search-submit" value="Search">
                    </form>
                    <a href="#0" title="Close Search" class="header__overlay-close">Close</a>
                </div> <!-- end header__search -->
                <a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>

                <nav class="header__nav-wrap">

                    <h2 class="header__nav-heading h6">Site Navigation</h2>

                    <ul class="header__nav">
                        <li class="current"><a href="/cms2/" title="">Home</a></li>
                        <li class="has-children">
                            <a href="#0" title="">Categories</a>
                            <ul class="sub-menu">
                                <?php foreach ($categoryController->getCategories() as  $value) : ?>
                                    <li><a href="/cms2/category/<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li><a href="/cms2/about" title="">About</a></li>
                        <li><a href="/cms2/contact" title="">Contact</a></li>
                        <?php  if(!Application::isGuest()) : ?>
                            <li class=""><a href="/cms2/favorites" title="">Favorites</a></li>
                        <li><a href="/cms2/account" title="">Account</a></li>
                        <?php endif;?>
                    </ul> <!-- end header__nav -->
                    <a href="#0" title="Close Menu" class="header__overlay-close close-mobile-menu">Close</a>
                </nav> <!-- end header__nav-wrap -->
            </div> <!-- header-content -->
        </header> <!-- header -->
    </section> <!-- end s-pageheader -->

<?=$this->section('content')?>

</body>
</html>

    <!-- s-footer
    ================================================== -->
    <footer class="s-footer">

        <div class="s-footer__main">
            <div class="row">

                <div class="col-two md-four mob-full s-footer__sitelinks">

                    <h4>Quick Links</h4>

                    <ul class="s-footer__linklist">
                        <li><a href="#0">Home</a></li>
                        <li><a href="#0">Blog</a></li>
                        <li><a href="#0">Styles</a></li>
                        <li><a href="#0">About</a></li>
                        <li><a href="#0">Contact</a></li>
                        <li><a href="#0">Privacy Policy</a></li>
                    </ul>

                </div> <!-- end s-footer__sitelinks -->

                <div class="col-two md-four mob-full s-footer__archives">

                    <h4>Archives</h4>

                    <ul class="s-footer__linklist">
                        <li><a href="#0">January 2018</a></li>
                        <li><a href="#0">December 2017</a></li>
                        <li><a href="#0">November 2017</a></li>
                        <li><a href="#0">October 2017</a></li>
                        <li><a href="#0">September 2017</a></li>
                        <li><a href="#0">August 2017</a></li>
                    </ul>

                </div> <!-- end s-footer__archives -->

                <div class="col-two md-four mob-full s-footer__social">

                    <h4>Social</h4>

                    <ul class="s-footer__linklist">
                        <li><a href="#0">Facebook</a></li>
                        <li><a href="#0">Instagram</a></li>
                        <li><a href="#0">Twitter</a></li>
                        <li><a href="#0">Pinterest</a></li>
                        <li><a href="#0">Google+</a></li>
                        <li><a href="#0">LinkedIn</a></li>
                    </ul>

                </div> <!-- end s-footer__social -->

                <div class="col-five md-full end s-footer__subscribe">

                    <h4>Our Newsletter</h4>

                    <p>Sit vel delectus amet officiis repudiandae est voluptatem. Tempora maxime provident nisi et fuga et enim exercitationem ipsam. Culpa consequatur occaecati.</p>

                    <div class="subscribe-form">
                        <form id="mc-form" class="group" novalidate="true">

                            <input type="email" value="" name="EMAIL" class="email" id="mc-email" placeholder="Email Address" required="">

                            <input type="submit" name="subscribe" value="Send">

                            <label for="mc-email" class="subscribe-message"></label>

                        </form>
                    </div>

                </div> <!-- end s-footer__subscribe -->

            </div>
        </div> <!-- end s-footer__main -->

        <div class="s-footer__bottom">
            <div class="row">
                <div class="col-full">
                    <div class="s-footer__copyright">
                        <span>© Copyright Philosophy 2018</span>
                        <span>Site Template by <a href="https://colorlib.com/">Colorlib</a></span>
                    </div>

                    <div class="go-top">
                        <a class="smoothscroll" title="Back to Top" href="#top"></a>
                    </div>
                </div>
            </div>
        </div> <!-- end s-footer__bottom -->

    </footer> <!-- end s-footer -->


    <!-- preloader
    ================================================== -->
    <!-- <div id="preloader">
        <div id="loader">
            <div class="line-scale">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div> -->


    <!-- Java Script
    ================================================== -->
    <script src="<?= PUBLIC_PATH ?>/philosophy/js/jquery-3.2.1.min.js"></script>
    <script src="<?= PUBLIC_PATH ?>/philosophy/js/plugins.js"></script>
    <script src="<?= PUBLIC_PATH ?>/philosophy/js/main.js"></script>

</body>

</html>