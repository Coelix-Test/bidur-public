<header id="header_main">
    @include('parts/header/top-line')
    <?php
    $postController = new \App\Http\Controllers\PostController();
    $twoPosts = $postController->getTwoRandomPosts();

    ?>
    
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
