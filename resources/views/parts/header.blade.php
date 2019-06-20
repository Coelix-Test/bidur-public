<header id="header_main">
    <div class="top-row">
        <div class="auth-btns">
            @if(!Auth::check())
                <a href="{{route('login')}}" class="btn-common btn-border-white">כניסה</a>
                <a href="{{route('register')}}" class="btn-common btn-red">הרשמה</a>
                @else
                <a href="{{route('logout')}}" class="btn-common btn-red">logout</a>
            @endif


        </div>

        <div class="socials-wrap">
            <a href="#" class="youtube">
                <svg width="25" height="19" viewBox="0 0 25 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.0778 0H5.31095C2.59714 0 0.388672 2.20843 0.388672 4.92228V13.1261C0.388672 15.8398 2.59714 18.0484 5.31095 18.0484H20.0778C22.7916 18.0484 25.0001 15.8398 25.0001 13.1261V4.92228C25.0001 2.20843 22.7916 0 20.0778 0ZM23.9062 13.1261C23.9062 15.2372 22.1889 16.9545 20.0778 16.9545H5.31095C3.19984 16.9545 1.48251 15.2372 1.48251 13.1261V4.92228C1.48251 2.81117 3.19984 1.09384 5.31095 1.09384H20.0778C22.1889 1.09384 23.9062 2.81117 23.9062 4.92228V13.1261ZM9.1394 13.6516L17.1545 9.0247L9.1394 4.39667V13.6516ZM10.2332 6.29123L14.9668 9.02474L10.2332 11.7571V6.29123Z"/>
                </svg>
            </a>
            <a href="#" class="instagram">
                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.64283 18.0484H15.4036C16.8614 18.0484 18.0474 16.8624 18.0474 15.4046V2.6438C18.0474 1.18599 16.8614 0 15.4036 0H2.64283C1.18502 0 -0.000976562 1.18599 -0.000976562 2.6438V15.4046C-0.000976562 16.8624 1.18502 18.0484 2.64283 18.0484ZM1.05654 2.6438C1.05654 1.76914 1.76817 1.05752 2.64283 1.05752H15.4036C16.2782 1.05752 16.9899 1.76914 16.9899 2.6438V15.4046C16.9899 16.2792 16.2782 16.9908 15.4036 16.9908H2.64283C1.76817 16.9908 1.05654 16.2792 1.05654 15.4046V2.6438Z" />
                <path d="M9.02325 13.783C11.6472 13.783 13.7821 11.6481 13.7821 9.02416C13.7821 6.40019 11.6472 4.26532 9.02325 4.26532C6.39927 4.26532 4.2644 6.40019 4.2644 9.02416C4.2644 11.6481 6.39927 13.783 9.02325 13.783ZM9.02325 5.32284C11.0642 5.32284 12.7246 6.9832 12.7246 9.02416C12.7246 11.0651 11.0642 12.7255 9.02325 12.7255C6.98229 12.7255 5.32193 11.0651 5.32193 9.02416C5.32193 6.9832 6.98229 5.32284 9.02325 5.32284Z" />
                <path d="M14.3109 5.32286C15.1855 5.32286 15.8972 4.61124 15.8972 3.73658C15.8972 2.86192 15.1855 2.1503 14.3109 2.1503C13.4362 2.1503 12.7246 2.86192 12.7246 3.73658C12.7246 4.61124 13.4362 5.32286 14.3109 5.32286ZM14.3109 3.20782C14.6024 3.20782 14.8397 3.44507 14.8397 3.73658C14.8397 4.02809 14.6024 4.26534 14.3109 4.26534C14.0194 4.26534 13.7821 4.02809 13.7821 3.73658C13.7821 3.44507 14.0194 3.20782 14.3109 3.20782Z" />
                </svg>
            </a>
            <a href="#" class="facebook">
                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.6438 18.0484H8.53067V11.6327H6.41563V9.51769H8.53067V6.87389C8.53067 5.41608 9.71666 4.23008 11.1745 4.23008H13.8183V6.34513H11.7032C11.1201 6.34513 10.6457 6.8195 10.6457 7.40265V9.51769H13.7228L13.3703 11.6327H10.6457V18.0484H15.4046C16.8624 18.0484 18.0484 16.8624 18.0484 15.4046V2.6438C18.0484 1.18599 16.8624 0 15.4046 0H2.6438C1.18599 0 0 1.18599 0 2.6438V15.4046C0 16.8624 1.18599 18.0484 2.6438 18.0484ZM1.05752 2.6438C1.05752 1.76914 1.76914 1.05752 2.6438 1.05752H15.4046C16.2792 1.05752 16.9908 1.76914 16.9908 2.6438V15.4046C16.9908 16.2792 16.2792 16.9908 15.4046 16.9908H11.7032V12.6903H14.2662L14.9712 8.46017H11.7032V7.40265H14.8758V3.17256H11.1745C9.13351 3.17256 7.47315 4.83293 7.47315 6.87389V8.46017H5.35811V12.6903H7.47315V16.9908H2.6438C1.76914 16.9908 1.05752 16.2792 1.05752 15.4046V2.6438Z"/>
                </svg>
            </a>
        </div>

        <ul class="menu-list menu">
            <li><a href="#">דף בית</a></li>
            <li><a href="#">אודות</a></li>
            <li><a href="#">צור קשר</a></li>
        </ul>
    </div><!-- top row end -->
    <?php
    $postController = new \App\Http\Controllers\PostController();
    $twoPosts = $postController->getTwoRandomPosts();

    ?>
    <div class="logo-row">
        <div class="container">
            <div class="row">
                <?php
                $info = $postController->getInfoOnPostForMain($twoPosts[0]->id);
                ?>
                    <div class="news-item col-3 offset-2">
                        <div class="img-wrap">
                            <img src="<?= $info['img']?>" alt="">
                        </div>
                        <div class="text-wrap">
                            <div class="title"><?= $info['title']?> </div>
                            <div class="meta"><span class="author">by <?= $info['author']?></span> | <span class="time"><?= $info['time']?></span></div>
                            <div class="stars">
                                <div class="star"></div>
                                <div class="star star-active"></div>
                                <div class="star star-active"></div>
                                <div class="star star-active"></div>
                                <div class="star star-active"></div>
                            </div>
                        </div>
                    </div>
                <div class="logo-wrap col-2 offset-2">
                    <img src="/img/logo.png" alt="">
                </div>
                <?php
                $info = $postController->getInfoOnPostForMain($twoPosts[1]->id);
                ?>
                    <div class="news-item col-3">
                        <div class="img-wrap">
                            <img src="<?= $info['img']?>" alt="">
                        </div>
                        <div class="text-wrap">
                            <div class="title"><?= $info['title']?> </div>
                            <div class="meta"><span class="author">by <?= $info['author']?></span> | <span class="time"><?= $info['time']?></span></div>
                            <div class="stars">
                                <div class="star"></div>
                                <div class="star star-active"></div>
                                <div class="star star-active"></div>
                                <div class="star star-active"></div>
                                <div class="star star-active"></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div><!-- logo row end-->
    <div class="celebrities-container container">
        <div class="row">
            <div class="col-12">
                <div class="celebrities-slider">
                    <?php
                    $hashtags = new \App\Http\Controllers\HashtagController();
                    $hashtags = $hashtags->getAllHashtags();
                    foreach ($hashtags as $hashtag) {
                        ?>
                        <a href="{{route('postByHashtag', ['id' => $hashtag['id']])}}" class="celebrity np-slide-item">
                            <div class="img-wrap">
                                <div class="image" style="background-image: url('<?=$hashtag['img']?>');"></div>
                            </div>
                            <div class="name"><?=$hashtag['name']?></div>
                        </a>
                        <?php
                    }
                    ?>
{{--                    @for ($i = 0; $i < 30; $i++)--}}
{{--                            <a href="#" class="celebrity np-slide-item">--}}
{{--                                <div class="img-wrap">--}}
{{--                                    <div class="image" style="background-image: url('/img/abama/4.png');"></div>--}}
{{--                                </div>--}}
{{--                                <div class="name">Barak Abama</div>--}}
{{--                            </a>--}}
{{--                    @endfor--}}
                </div>
            </div>
        </div>
    </div><!-- celebrities row end-->
    <div class="run-stroke-wrap">
        <ul class="run-stroke">
            <?php
            $post = new \App\Http\Controllers\PostController();
            $postTitles = $post->getAllPostTitles();

            foreach ($postTitles as $postTitle) {
                ?>
                <li><?= $postTitle['title']?></li>
                <?php
            }
            ?>
{{--            <li>Wild Miley Cyrus Is Back & Naughtier Than Ever</li>--}}
{{--            <li>Lorem ipsum dolor.</li>--}}
{{--            <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>--}}
{{--            <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>--}}
{{--            <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>--}}
{{--            <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>--}}
{{--            <li>Lorem ipsum.</li>--}}
        </ul>
        <ul class="run-stroke hidden">
            <?php
            foreach ($postTitles as $postTitle) {
            ?>
            <li><?= $postTitle['title']?></li>
            <?php
            }
            ?>
{{--            <li>Wild Miley Cyrus Is Back & Naughtier Than Ever</li>--}}
{{--            <li>Lorem ipsum dolor.</li>--}}
{{--            <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>--}}
{{--            <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>--}}
{{--            <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>--}}
{{--            <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>--}}
{{--            <li>Lorem ipsum.</li>--}}
        </ul>
    </div>

</header>
